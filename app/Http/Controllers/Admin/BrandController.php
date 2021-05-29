<?php

namespace App\Http\Controllers\Admin;

use App\Model\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="brand";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Brand','brand');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('used',function($row){
                return $row->productsCount();
            })
            ->editColumn('logo',function($row){
                return "<img class='data-table-img' src='".asset('images/brand/'.$row->logo)."'>";
            })
            ->editColumn('banner',function($row){
                return $row->banner?"<img class='data-table-img' src='".asset('images/brand/'.$row->banner)."'>":"";
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/brand/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
            })->rawColumns(['action','index','preview','status','logo','banner'])
            ->make(true);
      }
      
        return view('admin.brand.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        Brand::create([
            "name"=>$request->name,
            "slug"=>$request->slug,
            "logo"=>$request->logo,
            "banner"=>$request->banner,
            "meta_title"=>$request->meta_title,
            "status"=>$request->status,
            "meta_description"=>$request->meta_description,

            
        ]);
        return redirect()->route('brand.index')->with('success',LanguageService::getTranslate('BrandCreatedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',compact('brand')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update([
            "name"=>$request->name,
            "slug"=>$request->slug,
            "logo"=>$request->logo,
            "banner"=>$request->banner,
            "meta_title"=>$request->meta_title,
            "status"=>$request->status,
            "meta_description"=>$request->meta_description,

            
        ]);
    return redirect()->route('brand.index')->with('success',LanguageService::getTranslate('BrandUpdatedSuccessfully'));   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        
        if($brand->logo){ 
            if(file_exists(public_path('images/brand/'.$brand->logo))) {
            unlink(public_path('images/brand/'.$brand->logo));
            }
        }
        if($brand->banner){
            if(file_exists(public_path('images/brand/'.$brand->banner))) {
            unlink(public_path('images/brand/'.$brand->banner));
            }
        }
        $brand->delete();
        return LanguageService::getTranslate("BrandDeletedSuccessfully");
    }
    public function updateStatus(Brand $brand,$status){
        $brand->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("BrandUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $brand=Brand::find($id);
            if($brand->logo){
                if(file_exists(public_path('images/brand/'.$brand->logo))) {
                unlink(public_path('images/brand/'.$brand->logo));
                }
            }
            if($brand->banner){
                if(file_exists(public_path('images/brand/'.$brand->banner))) {
                unlink(public_path('images/brand/'.$brand->banner));
                }
            }
            $brand->delete();
        }
        return LanguageService::getTranslate("BrandDeletedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $badge=Brand::find($id);
            $badge->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("BrandUpdatedSuccessfully");
    }
}
