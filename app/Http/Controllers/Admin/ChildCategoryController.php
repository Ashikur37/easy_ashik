<?php

namespace App\Http\Controllers\Admin;

use App\Model\ChildCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChildCategoryRequest;
use App\Model\Category;
use App\Model\Product;
use App\Model\SubCategory;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="child-category";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('ChildCategory','child-category');
            return $table->get()->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('used',function($row){
                return $row->productsCount();
            })
            ->addColumn('subCategory',function($row){
                return $row->subCategory->name;
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/child-category/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
            })
            ->addColumn('is_featured',function($row){
                $checked="";
                if($row->is_featured==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/child-category/feature/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="feature" id="" value="1">
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
            })->rawColumns(['action','index','status','is_featured'])
            ->make(true);
      }
      
        return view('admin.child-category.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('name')->get();
        $subCategories=SubCategory::where('category_id',$categories[0]->id)->orderBy('name')->get();
        return view('admin.child-category.create',compact('categories','subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChildCategoryRequest $request)
    {
        //generating Slug
        if($request->slug){
            $slug=Str::slug($request->slug);
        }
        else{
            $slug=Str::slug($request->name);
        }
        //checking if slug exist
        if(ChildCategory::whereSlug($slug)->first()){
            $slug.=rand(10,99);
        }
        ChildCategory::create([
            "name"=>$request->name,
            "slug"=>$slug,
            "image"=>$request->image,
            "banner"=>$request->banner,
            "status"=>$request->status,
            "sub_category_id"=>$request->sub_category_id,
        ]);
        return redirect()->route('child-category.index')->with('success',LanguageService::getTranslate('ChildCategoryCreatedSuccessfully')); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildCategory $childCategory)
    {
        $categories=Category::orderBy('name')->get();
        $category_id=$childCategory->subCategory->category_id;
        $subCategories=SubCategory::where('category_id',$category_id)->orderBy('name')->get();
        return view('admin.child-category.edit',compact('category_id','childCategory','categories','subCategories')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ChildCategoryRequest $request, ChildCategory $childCategory)
    {
        //Generating Slug
        if($request->slug){
            $slug=Str::slug($request->slug);
        }
        else{
            $slug=Str::slug($request->name);
        }
        //checking if slug exist
        if(ChildCategory::whereSlug($slug)->where('id','!=',$childCategory->id)->first()){
            $slug.=rand(10,99);
        }
        $childCategory->update ([
            "name"=>$request->name,
            "slug"=>$slug,
            "image"=>$request->image,
            "banner"=>$request->banner,
            "status"=>$request->status,
            "sub_category_id"=>$request->sub_category_id,
        ]);
        return redirect()->route('child-category.index')->with('success',LanguageService::getTranslate('ChildCategoryUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildCategory $childCategory)
    {
        
        if($childCategory->image){
            if(file_exists(public_path('images/category/'.$childCategory->image))) {
            unlink(public_path('images/category/'.$childCategory->image));
            }
        }
        if($childCategory->banner){
            if(file_exists(public_path('images/category/'.$childCategory->banner))) {
            unlink(public_path('images/category/'.$childCategory->banner));
            }
        }
        Product::where('child_category_id', $childCategory->id)->update([
            'child_category_id' => 0
         ]);
        $childCategory->delete();
        return LanguageService::getTranslate("ChildCategoryDeletedSuccessfully");
    }
    public function updateStatus(ChildCategory $childCategory,$status){
        $childCategory->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("ChildCategoryUpdatedSuccessfully");
    }
    public function updateFeature(ChildCategory $childCategory,$status){
        $childCategory->update([
            "is_featured"=>$status
        ]);
        return LanguageService::getTranslate("ChildCategoryUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $childCategory=ChildCategory::find($id);
            if($childCategory->image){
                if(file_exists(public_path('images/category/'.$childCategory->image))) {

                    unlink(public_path('images/category/'.$childCategory->image));
                }
            }
            if($childCategory->banner){
                if(file_exists(public_path('images/category/'.$childCategory->banner))) {

                    unlink(public_path('images/category/'.$childCategory->banner));
                }
            }
            Product::where('child_category_id', $childCategory->id)->update([
                'child_category_id' => 0
             ]);
            $childCategory->delete();
        }
        return LanguageService::getTranslate("ChildCategoryDeletedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $childCategory=ChildCategory::find($id);
            $childCategory->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("ChildCategoryUpdatedSuccessfully");
    }
}
