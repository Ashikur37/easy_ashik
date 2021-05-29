<?php

namespace App\Http\Controllers\Admin;

use App\Model\Badge;
use App\Http\Controllers\Controller;
use App\Http\Requests\BadgeRequest;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="badge";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Badge','badge');
            return $table->get()->addColumn('preview',function($row){
                return "<span style='color:".$row->color.";background:".$row->background."' class='ts-badge-preview'>".$row->name."</span>";
            })  ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('used',function($row){
                return $row->productsCount()." ".LanguageService::getTranslate('Product');
            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/badge/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
      
        return view('admin.badge.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.badge.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BadgeRequest $request)
    {
        Badge::create([
            "name"=>$request->name,
            "color"=>$request->color,
            "background"=>$request->background,
            "status"=>$request->status,
        ]);
        return redirect()->route('badge.index')->with('success',LanguageService::getTranslate('BadgeCreatedSuccessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {
        return view('admin.badge.edit',compact('badge')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function update(BadgeRequest $request, Badge $badge)
    {
     $badge->update([
        "name"=>$request->name,
        "color"=>$request->color,
        "background"=>$request->background,
        "status"=>$request->status,
    ]);
    return redirect()->route('badge.index')->with('success',LanguageService::getTranslate('BadgeUpdatedSuccessfully'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badge $badge)
    {
        $badge->delete();
        return LanguageService::getTranslate("BadgeDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $badge=Badge::find($id);
            $badge->delete();
        }
        return LanguageService::getTranslate("BadgeDeletedSuccessfully");
    }
    public function updateStatus(Badge $badge,$status){
        $badge->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("BadgeUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $badge=Badge::find($id);
            $badge->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("BadgeUpdatedSuccessfully");
    }
}
