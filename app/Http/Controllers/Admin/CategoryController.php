<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Model\ChildCategory;
use App\Model\Product;
use App\Model\SubCategory;
use Illuminate\Support\Facades\URL;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="category";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Category','category');
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
            ->addColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/category/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
            })
            ->addColumn('is_featured',function($row){
                $checked="";
                if($row->is_featured==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/category/feature/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="feature" id="" value="1">
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
      
        return view('admin.category.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //generating Slug
        if($request->slug){
            $slug=Str::slug($request->slug);
        }
        else{
            $slug=Str::slug($request->name);
        }
        //checking if slug exist
        if(Category::whereSlug($slug)->first()){
            $slug.=rand(10,99);
        }
        Category::create([
            "name"=>$request->name,
            "slug"=>$slug,
            "image"=>$request->image,
            "banner"=>$request->banner,
            "status"=>$request->status,
        ]);
        return redirect()->route('category.index')->with('success',LanguageService::getTranslate('CategoryCreatedSuccessfully'));    
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //Generating Slug
        if($request->slug){
            $slug=Str::slug($request->slug);
        }
        else{
            $slug=Str::slug($request->name);
        }
        //checking if slug exist
        if(Category::whereSlug($slug)->where('id','!=',$category->id)->first()){
            $slug.=rand(10,99);
        }
        $category->update([
            "name"=>$request->name,
            "slug"=>$slug,
            "image"=>$request->image,
            "banner"=>$request->banner,
            "status"=>$request->status,
        ]);
        return redirect()->route('category.index')->with('success',LanguageService::getTranslate('CategoryUpdatedSuccessfully'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->image){
            if(file_exists(public_path('images/category/'.$category->image))) {
            unlink(public_path('images/category/'.$category->image));
            }
        }
        if($category->banner){
            if(file_exists(public_path('images/category/'.$category->banner))) {
            unlink(public_path('images/category/'.$category->banner));
            }
        }
        Product::where('category_id',$category->id)->delete();
        $subCategoryIds=$category->subCategories->pluck('id')->toArray();
        ChildCategory::whereIn('sub_category_id',$subCategoryIds)->delete();
        SubCategory::where('category_id',$category->id)->delete();
        $category->delete();
        return LanguageService::getTranslate("CategoryDeletedSuccessfully");
    }
    public function updateStatus(Category $category,$status){
        $category->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("CategoryUpdatedSuccessfully");
    }
    public function updateFeature(Category $category,$status){
        $category->update([
            "is_featured"=>$status
        ]);
        return LanguageService::getTranslate("CategoryUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $category=Category::find($id);
            if($category->image){
            if(file_exists(public_path('images/category/'.$category->image))) {
                unlink(public_path('images/category/'.$category->image));
             }
            } 
            if($category->banner){
            if(file_exists(public_path('images/category/'.$category->banner))) {
                unlink(public_path('images/category/'.$category->banner));
                }
            }
            Product::where('category_id',$category->id)->delete();
            $subCategoryIds=$category->subCategories->pluck('id')->toArray();
            ChildCategory::whereIn('sub_category_id',$subCategoryIds)->delete();
            SubCategory::where('category_id',$category->id)->delete();
            $category->delete();
        }
        return LanguageService::getTranslate("CategoryDeletedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $category=Category::find($id);
            $category->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("CategoryUpdatedSuccessfully");
    }
    public function loadSubCategory(Category $category){
        $subCategories=SubCategory::where('category_id',$category->id)->orderBy('name')->get();
        return view('load.sub-category',compact('subCategories'));
    }
}
