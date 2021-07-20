<?php

namespace App\Http\Controllers\Admin;

use App\Model\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Model\AttributeSet;
use App\Model\Badge;
use App\Model\BadgeProduct;
use App\Model\Brand;
use App\Model\Category;
use App\Model\ChildCategory;
use App\Model\Color;
use App\Model\Option;
use App\Model\OptionValue;
use App\Model\ProductColor;
use App\Model\ProductImage;
use App\Model\ProductOption;
use App\Model\ProductSize;
use App\Model\ProductTag;
use App\Model\Shop;
use App\Model\Size;
use App\Model\SubCategory;
use App\Model\Tag;
use DataTables;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Str;
use App\Services\LanguageService;
use Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = "product";
        $user = auth()->user();
        if (request()->ajax()) {
            return Datatables::of(Product::latest()->get())
                ->editColumn('image', function ($row) {
                    return "<img class='data-table-img' src='" . asset('images/product/' . $row->image) . "'>";
                })
                ->addColumn('index', function ($row) {
                    return '<div class="icheck-primary d-inline">
                                <input data-id="' . $row->id . '" class="check-element check-id"  type="checkbox" id="checkboxPrimary' . $row->id . '" >
                                <label for="checkboxPrimary' . $row->id . '">
                                </label>
                            </div>';
                })
                ->addColumn('status', function ($row) {
                    $checked = "";
                    if ($row->is_active == 1) {
                        $checked = "checked";
                    }
                    return '<label class="ts-swich-label d-inline">
                            <input data-href="' . URL::to('admin/product/status/' . $row->id) . '"  type="checkbox"' . $checked . ' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                            <span class="ts-swich-body"></span>
                            </label>';
                })
                ->addColumn('created', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('qty', function ($row) {
                    if ($row->qty < 0) {
                        return "";
                    }
                    return $row->qty;
                })
                ->editColumn('selling_price', function ($row) {
                    $curr = Session::get('currency');
                    $oldPrice = $row->selling_price;
                    $oldHtml = "";
                    if ($row->price != ($oldPrice * $curr->rate)) {
                        $oldHtml = "<span class='old-price'>" . $curr->sign . $oldPrice * $curr->rate . "</span>";
                    }
                    return $curr->sign . $row->price . $oldHtml;
                })
                ->addColumn('action', function ($row) use ($route, $user) {
                    $btn = '';
                    if ($user->can($route . '.edit')) {
                        $btn .= '<span class="ts-action-btn mr-2">
                                 <a href="' . route($route . ".edit", $row->id) . '"><i class="ri-pencil-line"></i></a>
                                 </span> ';
                    }
                    $btn .= '<span class="ts-action-btn mr-2">
                                 <a href="' . URL::to('/admin/product/' . $row->id . '/duplicate') . '"><i class="ri-file-copy-line"></i></a>
                                 </span> ';
                    if ($user->can($route . '.destroy')) {
                        $btn .= '<span class="ts-action-btn">
                                 <a class="delete-button" href="#" data-href="' . route($route . ".destroy", $row->id) . '"><i class="ri-delete-bin-line"></i></a>
                                </span>';
                    }
                    return $btn;
                })->rawColumns(['action', 'index', 'status', 'image', 'selling_price'])
                ->make(true);
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $badges = Badge::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $attributeSets = AttributeSet::orderBy('name')->with('attributes')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $shops = Shop::all();
        return view('admin.product.create', compact('colors', 'sizes', 'brands', 'shops', 'badges', 'categories', 'tags', 'attributeSets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //Generating Slug
        $slug = $request->slug ? $request->slug : $request->name;
        $slug = Str::slug($slug);
        //checking if slug exist
        $prod = Product::whereSlug($slug)->first();
        if ($prod) {
            $slug = $slug . rand(10, 100);
        }

        $product = Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'slug' => $slug,
            'price' => $request->price,
            'is_cod' => $request->is_cod ? 1 : 0,
            'advance_delivery_charge' => $request->advance_delivery_charge ? 1 : 0,
            'is_offer' => $request->is_offer ? 1 : 0,
            'cashback' => $request->cashback,
            'special_price' => $request->special_price,
            'special_price_start' => $request->special_price_start,
            'special_price_end' => $request->special_price_end,
            'selling_price' => $request->price,
            'sku' => $request->sku,
            'manage_stock' => 1,
            'qty' => $request->qty,
            'in_stock' => $request->in_stock,
            'viewed' => 0,
            'is_active' => 1,
            'details' => $request->details,
            'special_price_type' => $request->special_price_type,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'child_category_id' => $request->child_category_id,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $request->image,
            "price_type" => $request->price_type,
            "is_top" => $request->top ? 1 : 0,
            "is_trending" => $request->trending ? 1 : 0,
            "is_hot" => $request->hot ? 1 : 0,
            "best_deal" => $request->best_deal ? 1 : 0,
            "shop_id" => $request->shop_id,
            "inside_charge" => $request->inside_charge,
            "outside_charge" => $request->outside_charge
        ]);

        if ($request["option"]) {
            for ($i = 0; $i < count($request["option"]); $i++) {
                if (isset($request["option"][$i]["name"])) {
                    $option = Option::create([
                        "name" => $request["option"][$i]["name"],
                        "required" => isset($option["required"]) ? 1 : 0
                    ]);
                    $product->options()->create([
                        "option_id" => $option->id
                    ]);
                    for ($j = 0; $j < count($request["option"][$i]["label"]); $j++) {
                        $option->values()->create([
                            "label" => $request["option"][$i]["label"][$j],
                            "price" => $request["option"][$i]["price"][$j],

                        ]);
                    }
                }
            }
        }
        if ($request["attributes"]) {
            for ($i = 0; $i < count($request["attributes"]); $i++) {
                if ($request["attributes"][$i]["attribute_id"]) {
                    $pa = $product->attributes()->create([
                        "attribute_id" => $request["attributes"][$i]["attribute_id"]
                    ]);
                    for ($j = 0; $j < count($request["attributes"][$i]["values"]); $j++) {
                        $pa->values()->create([
                            "attribute_value_id" => $request["attributes"][$i]["values"][$j]
                        ]);
                    }
                }
            }
        }
        if ($request->gallery) {
            foreach (json_decode($request->gallery) as $image) {
                $product->images()->create([
                    "image" => $image
                ]);
            }
        }
        if ($request->tag) {
            foreach ($request->tag as $tag) {
                $product->tags()->create([
                    "tag_id" => $tag
                ]);
            }
        }
        if ($request->color) {
            for ($i = 0; $i < count($request->color); $i++) {
                if ($request->color[$i]) {
                    $product->colors()->create([
                        "color_id" => $request->color[$i],
                        "price" => $request->color_price[$i] ? $request->color_price[$i] : 0
                    ]);
                }
            }
        }
        if ($request->size) {
            for ($i = 0; $i < count($request->size); $i++) {
                if ($request->size[$i]) {
                    $product->sizes()->create([
                        "size_id" => $request->size[$i],
                        "price" => $request->size_price[$i] ? $request->size_price[$i] : 0
                    ]);
                }
            }
        }
        if ($request->badge) {
            foreach ($request->badge as $badge) {
                $product->badges()->create([
                    "badge_id" => $badge
                ]);
            }
        }
        return redirect()->route('product.index')->with('success', LanguageService::getTranslate('ProductCreatedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $productTags = $product->tags->pluck("tag_id")->toArray();
        $productBadges = $product->badges->pluck("badge_id")->toArray();
        $brands = Brand::orderBy('name')->get();
        $badges = Badge::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $attributeSets = AttributeSet::orderBy('name')->with('attributes')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $shops = Shop::all();
        return view('admin.product.edit', compact('productTags', 'shops', 'productBadges', 'colors', 'sizes', 'brands', 'badges', 'categories', 'tags', 'attributeSets', 'product'));
    }


    public function duplicate(Product $product)
    {

        $productTags = $product->tags->pluck("tag_id")->toArray();
        $productBadges = $product->badges->pluck("badge_id")->toArray();
        $brands = Brand::orderBy('name')->get();
        $badges = Badge::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $attributeSets = AttributeSet::orderBy('name')->with('attributes')->get();
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();
        $shops = Shop::all();
        return view('admin.product.duplicate', compact('productTags', 'shops', 'productBadges', 'colors', 'sizes', 'brands', 'badges', 'categories', 'tags', 'attributeSets', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        //Generating Slug
        $slug = $request->slug ? $request->slug : $request->name;
        $slug = Str::slug($slug);
        //checking if slug exist
        if (Product::whereSlug($slug)->where('id', '!=', $product->id)->first()) {
            $slug = $slug . rand(10, 100);
        }
        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'slug' => $slug,
            'price' => $request->price,
            'cashback' => $request->cashback,

            'special_price' => $request->special_price,
            'special_price_start' => $request->special_price_start,
            'special_price_end' => $request->special_price_end,
            'selling_price' => $request->price,
            'sku' => $request->sku,
            'manage_stock' => 1,
            'qty' => $request->qty,
            'in_stock' => $request->in_stock,
            'viewed' => 0,
            'details' => $request->details,
            'special_price_type' => $request->special_price_type,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'child_category_id' => $request->child_category_id,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $request->image,
            "price_type" => $request->price_type,
            'is_cod' => $request->is_cod ? 1 : 0,
            'advance_delivery_charge' => $request->advance_delivery_charge ? 1 : 0,
            'is_offer' => $request->is_offer ? 1 : 0,
            "is_top" => $request->top ? 1 : 0,
            "is_trending" => $request->trending ? 1 : 0,
            "is_hot" => $request->hot ? 1 : 0,
            "best_deal" => $request->best_deal ? 1 : 0,
            "shop_id" => $request->shop_id,
            "inside_charge" => $request->inside_charge,
            "outside_charge" => $request->outside_charge


        ]);
        if ($request["option"]) {
            foreach ($request["option"] as $k => $option) {
                if (isset($option["name"])) {
                    $option = Option::updateOrCreate([
                        "name" => $option["name"],
                    ], [
                        "required" => isset($option["required"]) ? 1 : 0
                    ]);
                    $product->options()->updateOrCreate([
                        "option_id" => $option->id
                    ]);
                    foreach ($request["option"][$k]["label"] as $key => $label) {
                        $option->values()->updateOrCreate([
                            "label" => $label
                        ], [
                            "price" => $request["option"][$k]["price"][$key],
                        ]);
                    }
                }
            }
        }
        foreach ($product->attributes as $attribute) {
            $attribute->delete();
        }
        if ($request["attributes"]) {
            foreach ($request["attributes"] as $k => $attribute) {
                // for($i=0;$i<count($request["attributes"]);$i++){
                if ($request["attributes"][$k]["attribute_id"]) {
                    $pa = $product->attributes()->create([
                        "attribute_id" => $request["attributes"][$k]["attribute_id"]
                    ]);

                    if (isset($request["attributes"][$k]["values"])) {
                        foreach ($request["attributes"][$k]["values"] as $key => $attribute) {
                            //for($j=0;$j<count($request["attributes"][$i]["values"]);$j++){
                            $pa->values()->create([
                                "attribute_value_id" => $request["attributes"][$k]["values"][$key]
                            ]);
                        }
                    }
                }
            }
        }
        foreach ($product->images as $image) {
            ProductImage::where('image', $image->image)->delete();
        }
        if ($request->gallery) {
            foreach (json_decode($request->gallery) as $image) {
                $product->images()->create([
                    "image" => $image
                ]);
            }
        }
        foreach ($product->tags as $tag) {
            ProductTag::where('tag_id', $tag->tag_id)->where('product_id', $tag->product_id)->delete();
        }
        if ($request->tag) {
            foreach ($request->tag as $tag) {
                $product->tags()->create([
                    "tag_id" => $tag
                ]);
            }
        }
        foreach ($product->colors as $color) {
            ProductColor::where('color_id', $color->color_id)->where('product_id', $color->product_id)->delete();
        }
        if ($request->color) {
            for ($i = 0; $i < count($request->color); $i++) {
                if ($request->color[$i]) {
                    $product->colors()->create([
                        "color_id" => $request->color[$i],
                        "price" => $request->color_price[$i] ? $request->color_price[$i] : 0
                    ]);
                }
            }
        }
        foreach ($product->sizes as $size) {
            ProductSize::where('size_id', $size->size_id)->where('product_id', $size->product_id)->delete();
        }
        if ($request->size) {
            for ($i = 0; $i < count($request->size); $i++) {
                if ($request->size[$i]) {
                    $product->sizes()->create([
                        "size_id" => $request->size[$i],
                        "price" => $request->size_price[$i] ? $request->size_price[$i] : 0
                    ]);
                }
            }
        }
        foreach ($product->badges as $badge) {
            BadgeProduct::where('badge_id', $badge->badge_id)->where('product_id', $badge->product_id)->delete();
        }
        if ($request->badge) {
            foreach ($request->badge as $badge) {
                $product->badges()->updateOrCreate([
                    "badge_id" => $badge
                ]);
            }
        }
        Session::flash('success', "Special message goes here");
        return redirect()->back()->with('success', LanguageService::getTranslate('ProductUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return LanguageService::getTranslate("ProductDeletedSuccessfully");
    }
    public function import()
    {
        return view('admin.product.import');
    }
    public function importSubmit(Request $request)
    {
        $rules = [
            'file'      => 'required|mimes:csv,txt',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return back()->with('error', 'Invalid file');
        }
        $filename = '';
        if ($file = request()->file('file')) {
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move('assets', $filename);
        }
        $datas = "";

        $file = fopen('assets/' . $filename, "r");
        $i = 1;
        while (($line = fgetcsv($file)) !== FALSE) {


            if ($i != 1) {
                $product = Product::create([
                    'name' => $line[0],
                    'slug' => Str::slug($line[0]) . rand(10, 90),
                    'price' => $line[2],
                    'selling_price' => $line[2],
                    'special_price' => $line[1],
                    'price_type' => 'discount',
                    'sku' => $line[3] ? $line[3] : rand(1000, 9999),
                    'manage_stock' => 1,
                    'qty' => $line[4],
                    'in_stock' => 1,
                    'viewed' => 0,
                    'is_active' => 1,
                    'details' => $line[5],
                    // 'special_price_type' => $request->special_price_type,
                    'category_id' => Category::whereName($line[6])->first()->id,
                    'sub_category_id' => SubCategory::whereName($line[7])->first() ? SubCategory::whereName($line[7])->first()->id : 0,
                    'child_category_id' => ChildCategory::whereName($line[8])->first() ? ChildCategory::whereName($line[8])->first()->id : 0,

                    'image' => $line[9],
                    "is_top" =>  0,
                    "is_trending" =>  0,
                    "is_hot" =>  0,
                    "best_deal" =>  0,

                ]);
                $images = explode(",", $line[10]);
                $colors = explode(",", $line[11]);
                $sizes = explode(",", $line[12]);
                foreach ($colors as $cname) {

                    $color = Color::whereName($cname)->first();
                    if ($color) {
                        $product->colors()->create([
                            "color_id" => $color->id,
                            "price" => 0
                        ]);
                    }
                }
                foreach ($sizes as $sname) {
                    $size = Size::whereName($sname)->first();
                    if ($size) {
                        $product->sizes()->create([
                            "size_id" => $size->id,
                            "price" => 0
                        ]);
                    }
                }
                foreach ($images as $image) {
                    if ($image) {
                        $product->images()->create([
                            "image" => $image
                        ]);
                    }
                }
            }

            $i++;
        }
        fclose($file);
        return redirect('/admin/product')->with('success', 'Product imported successfully');
    }

    public function multiDelete($ids)
    {
        foreach (json_decode($ids) as $id) {
            $product = Product::find($id);
            $product->delete();
        }
        return "ProductDeletedSuccessfully";
    }
    public function updateStatus(Product $product, $status)
    {
        $product->update([
            "is_active" => $status
        ]);
        return LanguageService::getTranslate("ProductUpdatedSuccessfully");
    }

    public function multiStatus($status, $ids)
    {
        foreach (json_decode($ids) as $id) {
            $product = Product::find($id);
            $product->update([
                "is_active" => $status
            ]);
        }
        return LanguageService::getTranslate("ProductUpdatedSuccessfully");
    }
    public function removeOption($product_id, $option_id)
    {
        ProductOption::where('option_id', $option_id)->where('product_id', $product_id)->delete();
        return "Product Option deleted successfully";
    }
    public function removeOptionValue($id)
    {
        OptionValue::where('id', $id)->delete();
        return "Product Option value deleted successfully";
    }
}
