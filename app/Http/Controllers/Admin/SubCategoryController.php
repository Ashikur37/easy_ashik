<?php

namespace App\Http\Controllers\Admin;

use App\Model\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Model\Category;
use App\Model\ChildCategory;
use App\Model\Product;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="sub-category";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('SubCategory','sub-category');
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
            ->addColumn('category',function($row){
                return $row->category->name;
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/sub-category/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
            })
            ->addColumn('is_featured',function($row){
                $checked="";
                if($row->is_featured==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/sub-category/feature/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="feature" id="" value="1">
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
      
        return view('admin.sub-category.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('name')->get();
        return view('admin.sub-category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        //generating Slug
        if($request->slug){
            $slug=Str::slug($request->slug);
        }
        else{
            $slug=Str::slug($request->name);
        }
        //checking if slug exist
        if(SubCategory::whereSlug($slug)->first()){
            $slug.=rand(10,99);
        }
        SubCategory::create([
            "name"=>$request->name,
            "slug"=>$slug,
            "image"=>$request->image,
            "banner"=>$request->banner,
            "status"=>$request->status,
            "category_id"=>$request->category_id,
        ]);
        return redirect()->route('sub-category.index')->with('success',LanguageService::getTranslate('SubCategoryCreatedSuccessfully'));   
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories=Category::orderBy('name')->get();
        return view('admin.sub-category.edit',compact('subCategory','categories')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        //Generating Slug
        if($request->slug){
            $slug=Str::slug($request->slug);
        }
        else{
            $slug=Str::slug($request->name);
        }
        //checking if slug exist
        if(SubCategory::whereSlug($slug)->where('id','!=',$subCategory->id)->first()){
            $slug.=rand(10,99);
        }
        $subCategory->update ([
            "name"=>$request->name,
            "slug"=>$slug,
            "image"=>$request->image,
            "banner"=>$request->banner,
            "status"=>$request->status,
            "category_id"=>$request->category_id,
            
        ]);
        return redirect()->route('sub-category.index')->with('success',LanguageService::getTranslate('SubCategoryUpdatedSuccessfully'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        
        $subCategory->delete();
        return LanguageService::getTranslate("SubCategoryDeletedSuccessfully");
        if($subCategory->image){
            if(file_exists(public_path('images/category'.$subCategory->image))) {
            unlink(public_path('images/category'.$subCategory->image));
            }
        }
        if($subCategory->banner){
            if(file_exists(public_path('images/category'.$subCategory->banner))) {
            unlink(public_path('images/category'.$subCategory->banner));
            }
        }
        //reset all products of subcategory
        ChildCategory::whereIn('sub_category_id',$subCategory->id)->delete();
        Product::where('sub_category_id', $subCategory->id)->update([
            'sub_category_id' => 0,
            'child_category_id'=>0
         ]);
        $subCategory->delete();
        return LanguageService::getTranslate("SubCategoryDeletedSuccessfully");
    }
    public function updateStatus(SubCategory $subCategory,$status){
        $subCategory->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("SubCategoryUpdatedSuccessfully");
    }
    public function updateFeature(SubCategory $subCategory,$status){
 
        $subCategory->update([
            "is_featured"=>$status
        ]);
        return LanguageService::getTranslate("SubCategoryUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $subCategory=SubCategory::find($id);
            if($subCategory->image){
                if(file_exists(public_path('images/category'.$subCategory->image))) {
                unlink(public_path('images/category'.$subCategory->image));
                }
            }
            if($subCategory->banner){
                if(file_exists(public_path('images/category'.$subCategory->banner))) {
                unlink(public_path('images/category'.$subCategory->banner));
                }
            }
            ChildCategory::whereIn('sub_category_id',$subCategory->id)->delete();
            Product::where('sub_category_id', $subCategory->id)->update([
                'sub_category_id' => 0,
                'child_category_id'=>0
             ]);
            $subCategory->delete();
        }
        return LanguageService::getTranslate("SubCategoryDeletedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $subCategory=SubCategory::find($id);
            $subCategory->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("SubCategoryUpdatedSuccessfully");
    }
    public function loadChildCategory($id){
        $childCategories=ChildCategory::where('sub_category_id',$id)->orderBy('name')->get();
        return view('load.child-category',compact('childCategories'));
    }
}
