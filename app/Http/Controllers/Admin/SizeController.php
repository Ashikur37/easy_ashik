<?php

namespace App\Http\Controllers\Admin;

use App\Model\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Services\Datatable;
use App\Services\LanguageService;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('Size','size');
            return $table->getAll();
      }
      
        return view('admin.size.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        Size::create([
            'name' => $request->name
        ]);

       return redirect()->route('size.index')->with('success',LanguageService::getTranslate('SizeCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('admin.size.edit',compact('size'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, Size $size)
    {
       $size->update([
            'name' => $request->name
        ]);

       return redirect()->route('size.index')->with('success',LanguageService::getTranslate('SizeUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return LanguageService::getTranslate("SizeDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $size=Size::find($id);
            $size->delete();
        }
        return LanguageService::getTranslate("SizeDeletedSuccessfully");
    }
}
