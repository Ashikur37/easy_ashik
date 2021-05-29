<?php

namespace App\Http\Controllers\Admin;

use App\Model\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Model\AttributeSet;
use App\Model\AttributeValue;
use App\Services\Datatable;
use App\Services\LanguageService;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="attribute";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Attribute','attribute');
            return $table->get()->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('created',function($row){
                return $row->created_at->diffForHumans();
            })
            ->addColumn('attributeSet',function($row){
                return $row->attributeSet->name;
            })
            ->addColumn('values',function($row){
                $val="";
                foreach($row->values as $value){
                    $val.=$value->value.", ";
                }
                return $val;
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
            })->rawColumns(['action','index','status','values'])
            ->make(true);
      }
      
        return view('admin.attribute.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $attributeSets=AttributeSet::orderBy('name')->get();
        return view('admin.attribute.create',compact('attributeSets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $attribute=Attribute::create([
            "name"=>$request->name,
            "status"=>0,
            "attribute_set_id"=>$request->attribute_set_id,

        ]);
        if($request->value)
        {
            foreach($request->value as $value){
                $attribute->values()->create([
                    "value"=>$value
                ]);
         }
        }
        return redirect()->route('attribute.index')->with('success',LanguageService::getTranslate('FeatureCreatedSuccsessfully')); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        
        $attributeSets=AttributeSet::orderBy('name')->get();
        $values=$attribute->values->pluck("value")->toArray();
        return view('admin.attribute.edit',compact('values','attribute','attributeSets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    { 
        $attribute->update([
            "name"=>$request->name,
            "status"=>0,
            "attribute_set_id"=>$request->attribute_set_id,

        ]);
        if($request->value)
        {
            foreach($request->value as $value){
                $attribute->values()->updateOrCreate([
                    "value"=>$value
                ]);
         }
        }
        return redirect()->route('attribute.index')->with('success',LanguageService::getTranslate('FeatureUpdatedSuccessfully')); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return LanguageService::getTranslate("FeatureDeletedSuccessfully");
    }
    public function updateStatus(Attribute $attribute,$status){
        $attribute->update([
            "status"=>$status
        ]);
        return LanguageService::getTranslate("FeatureUpdatedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $attribute=Attribute::find($id);
            $attribute->update([
                "status"=>$status
            ]);
        }
        return LanguageService::getTranslate("FeatureUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $attribute=Attribute::find($id);
            $attribute->delete();
        }
        return LanguageService::getTranslate("FeatureDeletedSuccessfully");
    }
    public function removeValue(Attribute $attribute,$value){
        $av=AttributeValue::where('attribute_id',$attribute->id)->where('value',$value)->first();
        if($av){
            $av->delete();
        }
    }
    public function loadValue(Attribute $attribute){
        $values=$attribute->values;
        return view('load.attribute-value',compact('values'));
    }
}
 