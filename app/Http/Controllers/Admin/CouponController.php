<?php

namespace App\Http\Controllers\Admin;

use App\Model\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Model\Product;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="coupon";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Coupon','coupon');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('used',function($row){
                return "10 products";
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->active==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/coupon/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
            })->rawColumns(['action','index','status'])
            ->make(true);
      }
      return view('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::orderBy('name')->get();
        return view('admin.coupon.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    { 
        
        if(!$request->limit){
            $request->merge([
                'limit' => -1,
            ]);
        }
        $coupon=Coupon::create($request->all());
       if($request->product)
        {
            foreach($request->product as $product)
        {
            $coupon->products()->create([
                "product_id"=>$product
            ]);
        }
        }
        return redirect()->route('coupon.index')->with('success',LanguageService::getTranslate('CouponCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $products=Product::orderBy('name')->get();
        $couponProducts =$coupon->products->pluck('product_id')->toArray();
        
        return view('admin.coupon.edit',compact('products','coupon','couponProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        if(!$request->limit){
            $request->merge([
                'limit' => -1,
            ]);
        }
        $coupon->update($request->all());
        foreach($coupon->products as $product){
            $product->delete();
        }
       if($request->product){
            foreach($request->product as $product)
            {
                $coupon->products()->create([
                    "product_id"=>$product
                ]);
            }
       }
        return redirect()->route('coupon.index')->with('success',LanguageService::getTranslate('CouponUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupon.index')->with('success',LanguageService::getTranslate('CouponDeletedSuccessfully'));

    }
    public function updateStatus(Coupon $coupon,$status){
        $coupon->update([
            "active"=>$status
        ]);
        return LanguageService::getTranslate("CouponUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $coupon=Coupon::find($id);
            $coupon->delete();
        }
        return LanguageService::getTranslate("CouponDeletedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $badge=Coupon::find($id);
            $badge->update([
                "active"=>$status
            ]);
        }
        return LanguageService::getTranslate("CouponUpdatedSuccessfully");
    }
}
