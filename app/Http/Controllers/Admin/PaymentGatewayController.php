<?php

namespace App\Http\Controllers\Admin;

use App\Model\PaymentGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentGatewayRequest;
use App\Services\Datatable;
use Illuminate\Support\Facades\URL;
use App\Model\PaymentGatewayAdditional;
use App\Services\LanguageService;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="payment-gateway";
        $user=auth()->user();
        if (request()->ajax()) {
            $table=new Datatable('PaymentGateway','payment-gateway');
            return $table->get() ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->is_active==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/payment-gateway/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
      
      
      
        return view('admin.payment-gateway.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment-gateway.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentGatewayRequest $request)
    {
        $paymentGateway=PaymentGateway::create([
            "title"=>$request->title,
            "details"=>$request->details,
            "is_active"=>1
        ]);
        if($request->ad_title){
            for($i=0;$i<count($request->ad_title);$i++){
                $paymentGateway->additionals()->create([
                    "title"=>$request->ad_title[$i],
                    "details"=>$request->ad_details[$i],
                    "required"=>1
                ]);
            }
        }
        return redirect()->route('payment-gateway.index')->with('success',LanguageService::getTranslate('PaymentGatewayCreatedSuccessfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGateway $paymentGateway)
    {
        return view('admin.payment-gateway.edit',compact('paymentGateway'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentGatewayRequest $request, PaymentGateway $paymentGateway)
    {
        $paymentGateway->update([
            "title"=>$request->title,
            "details"=>$request->details,
        ]);
        $old_ids=[];

        if($request->old_ad_title){
            foreach($request->old_ad_title as $old_id=>$title){
                array_push($old_ids,$old_id);
                $pa=PaymentGatewayAdditional::find($old_id);
                $pa->update([
                    "title"=>$title,
                    "details"=>$request->old_ad_details[$old_id],
                ]);
            }
        }
        //User::where('id',$id)->delete();
        PaymentGatewayAdditional::whereNotIn('id',$old_ids)->where('payment_gateway_id',$paymentGateway->id)->delete();
        if($request->ad_title){
            for($i=0;$i<count($request->ad_title);$i++){
                if($request->ad_title[$i]){
                    $paymentGateway->additionals()->create([
                        "title"=>$request->ad_title[$i],
                        "details"=>$request->ad_details[$i],
                        "required"=>1
                    ]);
                }
                
            }
        }
        return redirect()->route('payment-gateway.index')->with('success',LanguageService::getTranslate('PaymentGatewayUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        $paymentGateway->delete();
        return LanguageService::getTranslate("PaymentGatewayDeletedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $paymentGateway=PaymentGateway::find($id);
            $paymentGateway->delete();
        }
        return LanguageService::getTranslate("PaymentGatewayDeletedSuccessfully");
    }
    public function updateStatus(PaymentGateway $paymentGateway,$status){
        $paymentGateway->update([
            "is_active"=>$status
        ]);
        return LanguageService::getTranslate("PaymentGatewayUpdatedSuccessfully");
    }
    
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $paymentGateway=PaymentGateway::find($id);
            $paymentGateway->update([
                "is_active"=>$status
            ]);
        }
        return LanguageService::getTranslate("PaymentGatewayUpdatedSuccessfully");
    }
}
