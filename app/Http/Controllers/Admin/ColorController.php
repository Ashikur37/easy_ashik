<?php

namespace App\Http\Controllers\Admin;

use App\Model\Color;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Services\Datatable;
use App\Services\LanguageService;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="color";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Color','color');
            return $table->get()->editColumn('code',function($row){
                return "<span style='width:30px;height:30px;background:".$row->code."' class='ts-badge-preview'></span>";
            })  
            ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

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
            })->rawColumns(['action','index','code'])
            ->make(true);
      }
      
        return view('admin.color.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        Color::create([
            'name' => $request->name,
            'code'=>$request->code
        ]);

       return redirect()->route('color.index')->with('success',LanguageService::getTranslate('ColorCreatedSuccessfully'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.color.edit',compact('color'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, Color $color)
    {
       $color->update([
            'name' => $request->name,
            'code'=>$request->code
        ]);

       return redirect()->route('color.index')->with('success',LanguageService::getTranslate('ColorUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return LanguageService::getTranslate("ColorDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $color=Color::find($id);
            $color->delete();
        }
        return LanguageService::getTranslate("ColorDeletedSuccessfully");
    }
}
