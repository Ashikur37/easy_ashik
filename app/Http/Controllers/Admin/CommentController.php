<?php

namespace App\Http\Controllers\Admin;

use App\Model\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Model\ProductComment;
use App\Services\Datatable;
use App\Services\LanguageService;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="comment";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('ProductComment','comment',['Product','User']);
            return $table->get()-> 
            addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->editColumn('created_at',function($row){
                return $row->created_at->diffForHumans();
            })
            ->addColumn('action', function($row) use($user,$route){  
                    return '<span class="ts-action-btn">
                    <a class="delete-button" href="#" data-href="'.route($route.".destroy",$row->id).'"><i class="ri-delete-bin-line"></i></a>
                     </span>';
            })->rawColumns(['action','index','code'])
            ->make(true);
      }
      
        return view('admin.comment.index'); 
    }

    




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productComment=ProductComment::find($id);
        $productComment->delete();
        return LanguageService::getTranslate("CommentDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $productComment=ProductComment::find($id);
            $productComment->delete();
        }
        return LanguageService::getTranslate("CommentDeletedSuccessfully");
    }
}
