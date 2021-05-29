<?php

namespace App\Http\Controllers\Admin;

use App\Model\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Model\Product;
use App\Model\Withdraw;
use App\Services\Datatable;
use App\Services\LanguageService;
use App\Services\Notification;
use App\User;
use Illuminate\Support\Facades\URL;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="withdraw";
        $user=auth()->user();
        if (request()->ajax()) {
            $data=Withdraw::orderBy('id','desc')->get();
            $table=new Datatable('Withdraw','withdraw');
            return $table->getFromData($data) ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('name', function($row){
                return $row->user->name." ".$row->user->lastname;
            })
            ->addColumn('detail', function($row){
                if($row->method=='Bank'){
                    return "<ul class='list-group'>
                        <li class='list-group-item'>
                            Account Name:$row->account_name
                        </li>
                        <li class='list-group-item'>
                            IBAN:$row->iban
                        </li>
                        <li class='list-group-item'>
                        Address:$row->address
                        </li>
                         <li class='list-group-item'>
                         Swift:$row->swift
                        </li>
                    </ul>";
                }
                else{
                    return "<ul class='list-group'>
                    <li class='list-group-item'>
                        Email : $row->email
                    </li>
                </ul>";
                }
            })
            ->editColumn('status',function($row){
                $checked="";
                if($row->status==1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/withdraw/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="1">
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
            })->rawColumns(['action','index','status','detail'])
            ->make(true);
      }
      return view('admin.withdraw.index');
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        
        $withdraw=Withdraw::find($id);
        $withdraw->delete();
        return LanguageService::getTranslate("WithdrawDeletedSuccessfully");

    }
    public function updateStatus($id,$status){
        $withdraw=Withdraw::find($id);
        $withdraw->update([
            "status"=>$status
        ]);
        Notification::userWithdrawUpdate($id);
        return LanguageService::getTranslate("WithdrawUpdatedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $withdraw=Withdraw::find($id);
            $withdraw->update([
                "status"=>$status
            ]);
            Notification::userWithdrawUpdate($id);
        }
        return LanguageService::getTranslate("WithdrawUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $withdraw=Withdraw::find($id);
            $withdraw->delete();
        }
        return LanguageService::getTranslate("WithdrawDeletedSuccessfully");
    }
    
}
