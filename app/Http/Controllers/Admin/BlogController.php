<?php

namespace App\Http\Controllers\Admin;

use App\Model\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Model\BlogTag;
use App\Model\Tag;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="blog";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Blog','blog');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->editColumn('image',function($row){
                return "<img class='data-table-img' src='".asset('images/blog/'.$row->image)."'>";
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->show==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/blog/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
      
        return view('admin.blog.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::orderBy('name')->get();
        return view('admin.blog.create',compact('tags')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        if(!$request->slug){
            $request->merge([
                "slug"=>$request->title.rand(11,99)
            ]);
        }
        $blog=Blog::create($request->all());
        if($request->tag){
                foreach($request->tag as $tag){
                    $blog->tags()->attach($tag);
                }
        }
        return redirect()->route('blog.index')->with('success','BlogCreatedSuccessfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $tags=Tag::orderBy('name')->get();
        $blogTags=$blog->tags->pluck("id")->toArray();
        return view('admin.blog.edit',compact('tags','blog','blogTags')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());
            BlogTag::where('blog_id',$blog->id)->delete();
            if($request->tag){
                foreach($request->tag as $tag){
                    $blog->tags()->attach($tag);
                }
            }
        return redirect()->route('blog.index')->with('success',LanguageService::getTranslate('BlogUpdatedSuccessfully') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return LanguageService::getTranslate("BlogDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $blog=Blog::find($id);
            $blog->delete();
        }
        return LanguageService::getTranslate("BlogDeletedSuccessfully");
    }
    public function updateStatus(Blog $blog,$status){
        $blog->update([
            "show"=>$status
        ]);
        return LanguageService::getTranslate("BlogUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $blog=Blog::find($id);
            $blog->update([
                "show"=>$status
            ]);
        }
        return LanguageService::getTranslate("BlogUpdatedSuccessfully");
    }
}
