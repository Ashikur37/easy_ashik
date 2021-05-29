<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Datatable;
use App\Services\LanguageService;
use App\User;
use Illuminate\Support\Facades\URL;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route="customer";
        $user=auth()->user();
        if (request()->ajax()) {
            // sleep(1000);
            $data=User::where('type',0)->orWhere('type',-1)->orderBy('id','desc')->get();
            $table=new Datatable('User','customer');
            return $table->getFromData($data) ->addColumn('index', function($row){
                return '<div class="icheck-primary d-inline">
                <input data-id="'.$row->id.'" class="check-element check-id"  type="checkbox" id="checkboxPrimary'.$row->id.'" >
                <label for="checkboxPrimary'.$row->id.'">
                </label>
              </div>';

            })
            ->addColumn('status',function($row){
                $checked="";
                if($row->type==-1){
                    $checked="checked";
                }
                return '<label class="ts-swich-label d-inline">
                <input data-href="'.URL::to('admin/customer/status/'.$row->id).'"  type="checkbox"'.$checked.' class="switch-status switch ts-swich-input" name="status" id="" value="-1">
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
      return view('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $user=User::find($id);
        $user->delete();
        return LanguageService::getTranslate("CustomerDeletedSuccessfully");

    }
    public function updateStatus($id,$status){
        $user=User::find($id);
        $user->update([
            "type"=>$status==1?-1:0
        ]);
        return LanguageService::getTranslate("CustomerUpdatedSuccessfully");
    }
    public function multiStatus($status,$ids){
        foreach(json_decode($ids) as $id){
            $user=User::find($id);
            $user->update([
                "type"=>$status==1?-1:0
            ]);
        }
        return LanguageService::getTranslate("CustomerUpdatedSuccessfully");
    }
    public function multiDelete( $ids)
    {
        foreach(json_decode($ids) as $id){
            $customer=User::find($id);
            $customer->delete();
        }
        return LanguageService::getTranslate("CustomerDeletedSuccessfully");
    }
    
}
