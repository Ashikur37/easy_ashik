<?php

namespace App\Http\Controllers\Admin;

use App\Model\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="shop";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Shop','shop');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            
            ->editColumn('image',function($row){
                return "<img class='data-table-img' src='".asset('images/shop/'.$row->image)."'>";
            })
           
            ->addColumn('status',function($row){
                $checked="";
                if($row->is_active==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/shop/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
            })->rawColumns(['action','index','preview','status','image'])
            ->make(true);
      }
      
        return view('admin.shop.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        Shop::create([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "image"=>$request->image,
            "location"=>$request->location,
            "is_active"=>$request->is_active,
            
        ]);
        return redirect()->route('shop.index')->with('success',LanguageService::getTranslate('BrandCreatedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('admin.shop.edit',compact('shop')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $shop)
    {
        $shop->update([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "image"=>$request->image,
            "location"=>$request->location,
            "is_active"=>$request->is_active,
        ]);
    return redirect()->route('shop.index')->with('success',LanguageService::getTranslate('BrandUpdatedSuccessfully'));   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        
        if($shop->logo){ 
            if(file_exists(public_path('images/shop/'.$shop->logo))) {
            unlink(public_path('images/shop/'.$shop->logo));
            }
        }
        if($shop->banner){
            if(file_exists(public_path('images/shop/'.$shop->banner))) {
            unlink(public_path('images/shop/'.$shop->banner));
            }
        }
        $shop->delete();
        return LanguageService::getTranslate("BrandDeletedSuccessfully");
    }
    public function updateStatus(Shop $shop,$status){
        $shop->update([
            "is_active"=>$status
        ]);
        return LanguageService::getTranslate("BrandUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $shop=Shop::find($id);
            if($shop->logo){
                if(file_exists(public_path('images/shop/'.$shop->logo))) {
                unlink(public_path('images/shop/'.$shop->logo));
                }
            }
            if($shop->banner){
                if(file_exists(public_path('images/shop/'.$shop->banner))) {
                unlink(public_path('images/shop/'.$shop->banner));
                }
            }
            $shop->delete();
        }
        return LanguageService::getTranslate("BrandDeletedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $badge=Shop::find($id);
            $badge->update([
                "is_active"=>$status
            ]);
        }
        return LanguageService::getTranslate("BrandUpdatedSuccessfully");
    }
}
