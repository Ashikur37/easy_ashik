<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Attribute;
use App\Model\AttributeValue;
use App\Model\Brand;
use App\Model\Campaign;
use App\Model\Category;
use App\Model\ChildCategory;
use App\Model\Color;
use App\Model\Currency;
use App\Model\FlashSale;
use App\Model\key;
use App\Model\Option;
use App\Model\OptionValue;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\ProductAttribute;
use App\Model\ProductAttributeValue;
use App\Model\ProductColor;
use App\Model\ProductSize;
use App\Model\ShippingMethod;
use App\Model\Shop;
use App\Model\Size;
use App\Model\SubCategory;
use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Cart;

class CategoryController extends Controller
{

    public function index(Category $category, SubCategory $subCategory, ChildCategory $childCategory)
    {


        $key = false;
        if (request()->key) {
            $key = '%' . request()->key . '%';
            $term = Key::where('term', request()->key)->first();
            if ($term) {
                $term->hits += 1;
                $term->save();
            } else {
                Key::create([
                    "term" => request()->key,
                    "hits" => 1
                ]);
            }
        }
        $banner = "";
        $name = "";
        if ($childCategory->name) {
            $banner = $childCategory->banner;
            $name = $childCategory->name;
        } else if ($subCategory->name) {
            $banner = $subCategory->banner;
            $name = $subCategory->name;
        } else if ($category->name) {
            $banner = $category->banner;
            $name = $category->name;
        } else if (request()->key) {
            $name = LanguageService::getTranslate('ResultsShowingFor') . ' "' . request()->key . '"';
        }

        $category_id = $category->id;
        $sub_category_id = $subCategory->id;
        $child_category_id = $childCategory->id;
        $seller = request()->id;
        $products = Product::when($category_id, function ($query, $category_id) {
            return $query->where('category_id', $category_id);
        })
            ->when($seller, function ($query, $seller) {
                return $query->where('user_id', $seller);
            })
            ->when($sub_category_id, function ($query, $sub_category_id) {
                return $query->where('sub_category_id', $sub_category_id);
            })
            ->when($key, function ($query, $key) {
                return $query->where('name', 'like', $key);
            })
            ->when($child_category_id, function ($query, $child_category_id) {
                return $query->where('child_category_id', $child_category_id);
            })->with('brand')->orderBy('id', 'desc')->get();
        $maxPrice = $products->max('price');
        $minPrice = $products->min('price');

        $ids = $products->pluck('id')->toArray();
        $colorIds = ProductColor::whereIn('product_id', $ids)->distinct()->get(['color_id']);
        $colors = Color::whereIn('id', $colorIds)->get();
        $sizeIds = ProductSize::whereIn('product_id', $ids)->distinct()->get(['size_id']);
        $sizes = Size::whereIn('id', $sizeIds)->get();
        $brandIds = Product::whereIn('id', $ids)->distinct()->get(['brand_id'])->pluck('brand_id');
        $brands = Brand::whereIn('id', $brandIds)->get();
        $attributeIds = ProductAttribute::whereIn('product_id', $ids)->distinct()->get(['attribute_id']);
        $attributes = Attribute::whereIn('id', $attributeIds)->get(['id', 'name']);
        foreach ($attributes as $attribute) {
            $productAttributeIds = ProductAttribute::where('attribute_id', $attribute->id)->whereIn('product_id', $ids)->get('id');
            $attribute["datas"] = AttributeValue::whereHas('productAttributeValues', function ($q) use ($productAttributeIds) {
                $q->whereIn('product_attribute_id', $productAttributeIds);
            })->get(['value', 'id']);
        }
        $view = "grid";

        //return $products->links();
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        $products = (new Collection($products))->paginate(12);

        return view('front.category', compact('cartProducts', 'view', 'name', 'banner', 'products', 'maxPrice', 'minPrice', 'colors', 'sizes', 'brands', 'attributes'));
    }

    public function filter(Category $category, SubCategory $subCategory, ChildCategory $childCategory, Request $request)
    {
        $key = false;
        if (request()->key) {
            $key = '%' . request()->key . '%';
            $term = Key::where('term', request()->key)->first();
            if ($term) {
                $term->hits += 1;
                $term->save();
            } else {
                Key::create([
                    "term" => request()->key,
                    "hits" => 1
                ]);
            }
        }
        $sort = [["id", "1"], ["id", "1"], ["price", "0"], ["price", "1"], ["name", "0"], ["name", "1"], ["rating_percent", "1"], ["viewed", "1"]][$request->sort];
        $category_id = $category->id;
        $sub_category_id = $subCategory->id;
        $min_price = $request->min;
        $max_price = $request->max;
        $child_category_id = $childCategory->id;
        $colors = json_decode($request->colors);
        $sizes = json_decode($request->sizes);
        $brands = json_decode($request->brands);
        $view = $request->view;
        $attributes = json_decode($request->attrs);
        $curr = Session::get('currency');

        $rate = $curr->rate;
        $seller = request()->id;
        $products = Product::when($category_id, function ($query, $category_id) {
            return $query->where('category_id', $category_id);
        })
            ->when($seller, function ($query, $seller) {
                return $query->where('user_id', $seller);
            })
            ->when($colors, function ($query, $colors) {
                return $query->whereHas('colors', function ($q) use ($colors) {
                    $q->whereIn('color_id', $colors);
                });
            })
            ->when($attributes, function ($query, $attributes) {
                return $query->whereHas('attributeValues', function ($q) use ($attributes) {
                    $q->whereIn('attribute_value_id', $attributes);
                });
            })
            ->when($sizes, function ($query, $sizes) {
                return $query->whereHas('sizes', function ($q) use ($sizes) {
                    $q->whereIn('size_id', $sizes);
                });
            })->when($brands, function ($query, $brands) {
                return $query->whereIn('brand_id', $brands);
            })
            ->when($sub_category_id, function ($query, $sub_category_id) {
                return $query->where('sub_category_id', $sub_category_id);
            })
            ->when($key, function ($query, $key) {
                return $query->where('name', 'like', $key);
            })
            ->when($child_category_id, function ($query, $child_category_id) {
                return $query->where('child_category_id', $child_category_id);
            })->with('brand')->get();

        if ($sort[1] == 0) {
            $products = $products->sortBy($sort[0]);
        } else {
            $products = $products->sortByDesc($sort[0]);
        }
        $maxPrice = $products->max('price');
        $minPrice = $products->min('price');
        $products = $products->filter(function ($product) use ($min_price, $max_price) {
            return $product->price >= $min_price && $product->price <= $max_price;
        });

        // $products=(new Collection($products))->paginate(request()->pageLength);
        $products = (new Collection($products))->paginate(request()->pageLength);
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('load.front.category', compact('cartProducts', 'products', 'min_price', 'max_price', 'view'));
    }


    public function shop($name)
    {
        $shop = Shop::whereName($name)->firstOrFail();
        $products = Product::where('shop_id', $shop->id)->with('brand')->get();
        $cartProducts = [];


        $maxPrice = $products->max('price');
        $minPrice = $products->min('price');

        $ids = $products->pluck('id')->toArray();
        $colorIds = ProductColor::whereIn('product_id', $ids)->distinct()->get(['color_id']);
        $colors = Color::whereIn('id', $colorIds)->get();
        $sizeIds = ProductSize::whereIn('product_id', $ids)->distinct()->get(['size_id']);
        $sizes = Size::whereIn('id', $sizeIds)->get();
        $brandIds = Product::whereIn('id', $ids)->distinct()->get(['brand_id'])->pluck('brand_id');
        $brands = Brand::whereIn('id', $brandIds)->get();
        $attributeIds = ProductAttribute::whereIn('product_id', $ids)->distinct()->get(['attribute_id']);
        $attributes = Attribute::whereIn('id', $attributeIds)->get(['id', 'name']);
        foreach ($attributes as $attribute) {
            $productAttributeIds = ProductAttribute::where('attribute_id', $attribute->id)->whereIn('product_id', $ids)->get('id');
            $attribute["datas"] = AttributeValue::whereHas('productAttributeValues', function ($q) use ($productAttributeIds) {
                $q->whereIn('product_attribute_id', $productAttributeIds);
            })->get(['value', 'id']);
        }
        $view = "grid";

        //return $products->links();
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        $products = (new Collection($products))->paginate(12);
        return view('front.single-shop', compact('cartProducts', 'shop', 'view', 'products', 'maxPrice', 'minPrice', 'colors', 'sizes', 'brands', 'attributes'));
    }
    public function shopSort($name, Request $request)
    {
        $shop = Shop::whereName($name)->firstOrFail();
        $key = false;
        if (request()->key) {
            $key = '%' . request()->key . '%';
            $term = Key::where('term', request()->key)->first();
            if ($term) {
                $term->hits += 1;
                $term->save();
            } else {
                Key::create([
                    "term" => request()->key,
                    "hits" => 1
                ]);
            }
        }
        $sort = [["id", "1"], ["id", "1"], ["price", "0"], ["price", "1"], ["name", "0"], ["name", "1"], ["rating_percent", "1"], ["viewed", "1"]][$request->sort];
        $min_price = $request->min;
        $max_price = $request->max;
        $colors = json_decode($request->colors);
        $sizes = json_decode($request->sizes);
        $brands = json_decode($request->brands);
        $view = $request->view;
        $attributes = json_decode($request->attrs);
        $curr = Session::get('currency');

        $rate = $curr->rate;
        $seller = request()->id;
        $products = Product::where('shop_id', $shop->id)->when($seller, function ($query, $seller) {
            return $query->where('user_id', $seller);
        })
            ->when($colors, function ($query, $colors) {
                return $query->whereHas('colors', function ($q) use ($colors) {
                    $q->whereIn('color_id', $colors);
                });
            })
            ->when($attributes, function ($query, $attributes) {
                return $query->whereHas('attributeValues', function ($q) use ($attributes) {
                    $q->whereIn('attribute_value_id', $attributes);
                });
            })
            ->when($sizes, function ($query, $sizes) {
                return $query->whereHas('sizes', function ($q) use ($sizes) {
                    $q->whereIn('size_id', $sizes);
                });
            })->when($brands, function ($query, $brands) {
                return $query->whereIn('brand_id', $brands);
            })
            ->when($key, function ($query, $key) {
                return $query->where('name', 'like', $key);
            })
            ->with('brand')->get();

        if ($sort[1] == 0) {
            $products = $products->sortBy($sort[0]);
        } else {
            $products = $products->sortByDesc($sort[0]);
        }
        $maxPrice = $products->max('price');
        $minPrice = $products->min('price');
        $products = $products->filter(function ($product) use ($min_price, $max_price) {
            return $product->price >= $min_price && $product->price <= $max_price;
        });

        // $products=(new Collection($products))->paginate(request()->pageLength);
        $products = (new Collection($products))->paginate(request()->pageLength);
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('load.front.category', compact('cartProducts', 'products', 'min_price', 'max_price', 'view'));
    }
    public function flashSale($name)
    {
        $flashSale = FlashSale::where('title', $name)->where('end', '>=', today())->orderBy('id', 'desc')->first();
        $products = $flashSale->flashProducts;
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('front.flash-sale', compact('cartProducts', 'products', 'flashSale'));
    }

    //singleCampaign
    public function singleCampaign($title)
    {
        $campaign = Campaign::where('title', $title)->first();
        $products = $campaign->campaignProducts;
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('front.single-campaign', compact('cartProducts', 'products', 'campaign'));
    }
    public function singleCampaignSort($title, Request $request)
    {

        $sort = [["id", "0"], ["id", "1"], ["price", "0"], ["price", "1"], ["name", "0"], ["name", "1"], ["rating_percent", "1"], ["viewed", "1"]][$request->sort];
        $campaign = Campaign::where('title', $title)->first();
        $products = $campaign->campaignProducts;
        if ($sort[1] == 0) {
            $products = $products->sortBy($sort[0]);
        } else {
            $products = $products->sortByDesc($sort[0]);
        }
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('load.front.flash-sale', compact('cartProducts', 'products'));
    }



    public function flashSaleSort(Request $request)
    {

        $sort = [["id", "0"], ["id", "1"], ["price", "0"], ["price", "1"], ["name", "0"], ["name", "1"], ["rating_percent", "1"], ["viewed", "1"]][$request->sort];
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>=', today())->orderBy('id', 'desc')->first();
        $products = $flashSale->flashProducts;
        if ($sort[1] == 0) {
            $products = $products->sortBy($sort[0]);
        } else {
            $products = $products->sortByDesc($sort[0]);
        }
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('load.front.flash-sale', compact('cartProducts', 'products'));
    }


    public function bestSale()
    {

        $bestSaleProducts = OrderProduct::groupBy('product_id')->selectRaw('sum(order_products.qty) as product_count,product_id')
            ->with('product')
            ->orderBy('product_count', 'desc')->limit(20)->get();
        $products = [];
        foreach ($bestSaleProducts as $product) {
            array_push($products, $product->product);
        }
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('front.best-sale', compact('cartProducts', 'products'));
    }
    public function bestSaleSort(Request $request)
    {

        $sort = [["id", "0"], ["id", "1"], ["price", "0"], ["price", "1"], ["name", "0"], ["name", "1"], ["rating_percent", "1"], ["viewed", "1"]][$request->sort];

        $bestSaleProducts = OrderProduct::groupBy('product_id')->selectRaw('sum(order_products.qty) as product_count,product_id')
            ->with('product')
            ->orderBy('product_count', 'desc')->limit(20)->get();
        $products = [];
        foreach ($bestSaleProducts as $product) {
            array_push($products, $product->product);
        }
        $products = collect($products);
        if ($sort[1] == 0) {
            $products = $products->sortBy($sort[0]);
        } else {
            $products = $products->sortByDesc($sort[0]);
        }
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        return view('load.front.flash-sale', compact('cartProducts', 'products'));
    }


    public function categories()
    {
        return view('front.categories');
    }
}
