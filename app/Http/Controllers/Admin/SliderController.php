<?php

namespace App\Http\Controllers\Admin;

use App\Model\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="slide";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Slide','slide');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('direction',function($row){
                return $row->direction==1?'Left to right':'Right to left';
            })
            ->editColumn('image',function($row){
                return "<img class='data-table-img' src='".asset('images/slider/'.$row->image)."'>";
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/slide/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
            })
            ->editColumn('open_in_new_window',function($row){
                    return $row->open_in_new_window==1?LanguageService::getTranslate('NewWindow'):LanguageService::getTranslate('CurrentWindow');
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
      
        return view('admin.slide.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        Slide::create($request->all());
        return redirect()->route('slide.index')->with('success',LanguageService::getTranslate('SliderCreatedSuccessfully')); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        
        
        return view('admin.slide.edit',compact('slide')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slide $slide)
    {
        $slide->update($request->all());
        return redirect()->route('slide.index')->with('success',LanguageService::getTranslate('SliderupdatedSuccessfully')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return LanguageService::getTranslate("SliderDeletedsuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $slide=Slide::find($id);
            $slide->delete();
        }
        return LanguageService::getTranslate("SliderDeletedsuccessfully");
    }
    public function updateStatus(Slide $slide,$status){
      
        $slide->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("SliderupdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $slide=Slide::find($id);
            $slide->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("SliderupdatedSuccessfully");
    }

}
