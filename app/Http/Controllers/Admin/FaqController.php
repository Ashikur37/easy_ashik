<?php

namespace App\Http\Controllers\Admin;

use App\Model\Faq;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="faq";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Faq','faq');
            return $table->get()  ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->editColumn('details',function($row){
                return Str::limit($row->details,150);
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->is_active==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/faq/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
            })->rawColumns(['action','index','preview','status'])
            ->make(true);
      }
      
        return view('admin.faq.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        Faq::create([
            "title"=>$request->title,
            "details"=>$request->details,
            "is_active"=>1,
        ]);
        return redirect()->route('faq.index')->with('success',LanguageService::getTranslate('FAQCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit',compact('faq')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
     $faq->update([
        "title"=>$request->title,
        "details"=>$request->details,
    ]);
    return redirect()->route('faq.index')->with('success',LanguageService::getTranslate('FAQUpdatedSuccessfully'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return LanguageService::getTranslate("FAQDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $faq=Faq::find($id);
            $faq->delete();
        }
        return LanguageService::getTranslate("FAQDeletedSuccessfully");
    }
    public function updateStatus(Faq $faq,$status){
        $faq->update([
            "is_active"=>$status
        ]);
        return LanguageService::getTranslate("FAQUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $faq=Faq::find($id);
            $faq->update([
                "is_active"=>$status
            ]);
        }
        return LanguageService::getTranslate("FAQUpdatedSuccessfully");
    }
}
