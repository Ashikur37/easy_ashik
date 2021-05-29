<?php

namespace App\Http\Controllers\Admin;

use App\Model\ShippingMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodRequest;
use App\Services\Datatable;
use App\Services\LanguageService;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $table=new Datatable('ShippingMethod','shipping-method',null,'is_active');
            return $table->getAllWithStatus();
      }
      
        return view('admin.shipping-method.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping-method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingMethodRequest $request)
    {
        ShippingMethod::create($request->all());
        return redirect()->route('shipping-method.index')->with('success',LanguageService::getTranslate('ShippingMethodCreatedSuccessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping-method.edit',compact('shippingMethod')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        $shippingMethod->update($request->all());
        return redirect()->route('shipping-method.index')->with('success',LanguageService::getTranslate('ShippingMethodUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ShippingMethod  $shippingMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();
        return LanguageService::getTranslate("ShippingMethodDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $shippingMethod=ShippingMethod::find($id);
            $shippingMethod->delete();
        }
        return LanguageService::getTranslate("ShippingMethodDeletedSuccessfully");
    }
    public function updateStatus(ShippingMethod $shippingMethod,$status){
        $shippingMethod->update([
            "is_active"=>$status
        ]);
        return LanguageService::getTranslate("ShippingMethodUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $shippingMethod=ShippingMethod::find($id);
            $shippingMethod->update([
                "is_active"=>$status
            ]);
        }
        return LanguageService::getTranslate("ShippingMethodUpdatedSuccessfully");
    }
}
