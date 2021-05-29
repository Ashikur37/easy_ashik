<?php

namespace App\Http\Controllers\Admin;

use App\Model\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Model\Product;
use App\Services\Datatable;
use App\Services\LanguageService;
use Illuminate\Support\Facades\URL;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="currency";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('Currency','currency');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->is_default==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/currency/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
                <span class="ts-swich-body"></span>
              </label>';
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
            })->rawColumns(['action','index','status'])
            ->make(true);
      }
      return view('admin.currency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::orderBy('name')->get();
        return view('admin.currency.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    { 
        
        Currency::create($request->all());
        return redirect()->route('currency.index')->with('success',LanguageService::getTranslate('CurrencyCreatedSuccessfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {

        
        return view('admin.currency.edit',compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {

        $currency->update($request->all());
        return redirect()->route('currency.index')->with('success',LanguageService::getTranslate('CurrencyUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return LanguageService::getTranslate("CurrencyDeletedSuccessfully");

    }
    public function updateStatus(Currency $currency,$status){
        if($status==1){
            $currencies=Currency::all();
            foreach($currencies as $cur){
                $cur->update([
                    "is_default"=>0
                ]);
            }
        }
        $currency->update([
            "is_default"=>$status
        ]);
        return LanguageService::getTranslate("CurrencyUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $currency=Currency::find($id);
            $currency->delete();
        }
        return LanguageService::getTranslate("CurrencyDeletedSuccessfully");
    }
    
}
