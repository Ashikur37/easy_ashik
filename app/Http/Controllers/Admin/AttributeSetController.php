<?php

namespace App\Http\Controllers\Admin;

use App\Model\AttributeSet;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeSetRequest;
use App\Services\Datatable;
use App\Services\LanguageService;

class AttributeSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('AttributeSet','attribute-set');
            return $table->getAll();
      }
      
        return view('admin.attribute-set.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute-set.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeSetRequest $request)
    {
        AttributeSet::create([
            'name' => $request->name
        ]);

       return redirect()->route('attribute-set.index')->with('success',LanguageService::getTranslate('FeatureSetCreatedSuccessfully'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeSet $attributeSet)
    {
        return view('admin.attribute-set.edit',compact('attributeSet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeSetRequest $request, AttributeSet $attributeSet)
    {
        $attributeSet->update([
            'name' => $request->name
        ]);

       return redirect()->route('attribute-set.index')->with('success',LanguageService::getTranslate('FeatureSetUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeSet $attributeSet)
    {
        $attributeSet->delete();
        return LanguageService::getTranslate("FeatureSetDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $attributeSet=AttributeSet::find($id);
            $attributeSet->delete();
        }
        return LanguageService::getTranslate("FeatureSetDeletedSuccessfully");
    }
}
