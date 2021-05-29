<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Withdraw;
use App\Services\LanguageService;
use App\Services\Notification;
use App\User;
use Illuminate\Http\Request;

class AffiliationController extends Controller
{

    public function index()
    {
        return view('user.affiliation.index');
    }
    public function withdraw()
    {
        $withdraws=Withdraw::where('user_id',auth()->user()->id)->paginate(10);
        return view('user.withdraw.index',compact('withdraws'));
    }
    public function createWithdraw(){
        return view('user.withdraw.create');
    }
    public function storeWithdraw(Request $request){
        //checking balance
        if($request->amount>auth()->user()->affiliate_balance){
            return back()->with('error',LanguageService::getTranslate('InsufficientBalance'));
        }
        if($request->method=='Bank'){
            $ref=$request->banke_reference;
        }
        else{
            $ref=$request->email_reference;
        }
        $withdraw=Withdraw::create([
            "user_id"=>auth()->user()->id,
            "amount"=>$request->amount,
            "status"=>0,
            "account_name"=>$request->account_name,
            "email"=>$request->email,
            "method"=>$request->method,
            "iban"=>$request->iban,
            "address"=>$request->address,
            "swift"=>$request->swift,
            "reference"=>$ref,
        ]);
        $user=User::find(auth()->user()->id);
        $user->affiliate_balance-=$request->amount;
        $user->save();
        //notify admin
        Notification::userNewWithdraw($withdraw->id);
        return redirect()->route('user.withdraw')->with('success',LanguageService::getTranslate('WithdrawCreatedSuccessfully'));
    }
}
