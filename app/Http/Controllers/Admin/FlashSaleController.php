<?php

namespace App\Http\Controllers\Admin;

use App\Model\FlashSale;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlashSaleRequest;
use App\Model\FlashSaleProduct;
use App\Model\Product;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;
use Cache;
class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="flash-sale";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('FlashSale','flash-sale');
            return $table->get()  ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->editColumn('image',function($row){
                return "<img class='data-table-img' src='".asset('images/flash-sale/'.$row->image)."'>";
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->is_active==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/flash-sale/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
            })
            ->addColumn('created',function($row){
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function($row) use($user,$route){
                $btn='';
                if($user->can($route.'.edit')){
                    $btn.='<span class="ts-action-btn mr-2">
                    <a href="'.route($route.".edit",$row->id).'"><i class="ri-pencil-line"></i></a>
                </span> ';
                }
                
            if($user->can($route.'.destroy')){
                $btn.='<span class="ts-action-btn">
                <a class="delete-button" href="#" data-href="'.route($route.".destroy",$row->id).'"><i class="ri-delete-bin-line"></i></a>
            </span>';    
            }
                    return $btn;
            })->rawColumns(['action','index','image','status'])
            ->make(true);
      }
      
        return view('admin.flash-sale.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::orderBy('name')->get();
        return view('admin.flash-sale.create',compact('products')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlashSaleRequest $request)
    {
        $flashSale=FlashSale::create([
            "title"=>$request->title,
            "is_active"=>1,
            "image"=>$request->image,
            "end"=>$request->end,

        ]);
        for($i=0;$i<count($request->product);$i++)
        {
            if($request->price[$i]){
                $flashSale->products()->create([
                    "product_id"=>$request->product[$i],
                    "price"=>$request->price[$i],
                    "qty"=>$request->qty[$i],
                ]);
            }
           
            
        }
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        return redirect()->route('flash-sale.index')->with('success',LanguageService::getTranslate('FlashSaleCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\FlashSale  $flashSale
     * @return \Illuminate\Http\Response
     */
    public function edit(FlashSale $flashSale)
    {
        $products=Product::orderBy('name')->get();
        return view('admin.flash-sale.edit',compact('flashSale','products')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\FlashSale  $flashSale
     * @return \Illuminate\Http\Response
     */
    public function update(FlashSaleRequest $request, FlashSale $flashSale)
    {
     $flashSale->update([
        "title"=>$request->title,
        "is_active"=>1,
        "image"=>$request->image,
        "end"=>$request->end,

    ]);
    foreach ($flashSale->products as $product) {
        $product->delete();
    }
    for($i=0;$i<count($request->product);$i++)
        {
            if($request->price[$i]){
            $flashSale->products()->create([
                "product_id"=>$request->product[$i],
                "price"=>$request->price[$i],
                "qty"=>$request->qty[$i],
            ]);
            } 
        }
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
    return redirect()->route('flash-sale.index')->with('success',LanguageService::getTranslate('FlashSaleUpdatedSuccessfully'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\FlashSale  $flashSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlashSale $flashSale)
    {
        $flashSale->delete();
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $flashSale=FlashSale::find($id);
            $flashSale->delete();
        }
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleDeletedSuccessfully");
    }
    public function updateStatus(FlashSale $flashSale,$status){
        if($status==1){
            FlashSale::where('is_active',1)->update(['is_active' => 0]);
        }
        $flashSale->update([
            "is_active"=>$status
        ]);
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $flashSale=FlashSale::find($id);
            $flashSale->update([
                "is_active"=>$status
            ]);
        }
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleUpdatedSuccessfully");
    }
    public function removeFlashProduct($id){
        $flashProduct=FlashSaleProduct::find($id);
        $flashProduct->delete();
        $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
        if ($flashSale) {
            $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
        }
        Cache::put('flashSale', $flashSale, now()->addMinutes(10));
        Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        return LanguageService::getTranslate("FlashSaleDeletedSuccessfully");
    }
}
