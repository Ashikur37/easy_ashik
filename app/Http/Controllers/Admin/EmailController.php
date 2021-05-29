<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EmailSetting;
use App\Model\Subscriber;
use App\Services\LanguageService;
use App\Services\MailService;
use App\User;
use DataTables;
class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.email.group');
    }

    public function sendEmail(Request $request){
        //if subscriber
            if($request->group=='subscriber'){
                MailService::sendToManySubscriber($request->subject,$request->body);
            }
        //if customer
           else if($request->group=='customer'){
                $emails=User::where('type',0)->select('email')->get();
            //send email
            MailService::sendToMany($emails,$request->subject,$request->body);
            }
        //if user
            else if($request->group=='user'){
                $emails=User::where('type',3)->select('email')->get();
                //send email
            MailService::sendToMany($emails,$request->subject,$request->body);
            }
            
        
        //return success
        
            return back()->with('success',LanguageService::getTranslate('MailSentSuccessfully'));

    }
    public function config(){
         $emailSetting=EmailSetting::first();
         return view('admin.email.setting',compact('emailSetting'));
    }
    public function updateSetting(Request $request){
        $emailSetting=EmailSetting::first();
        $emailSetting->update([
            'smtp_host'=>$request->smtp_host,
            'smtp_port'=>$request->smtp_port,
            'smtp_user'=>$request->smtp_user,
            'smtp_pass'=>$request->smtp_pass,
            'from_email'=>$request->from_email,
            'from_name'=>$request->from_name,
            'is_active'=>$request->is_active?1:0,
            'mail_encryption'=>$request->mail_encryption
        ]);
        return back()->with('success',LanguageService::getTranslate('MailSettingUpdatedSuccessfully'));
    }

    public function subscriber()
    {

        if (request()->ajax()) {
            $data=Subscriber::latest()->get();
            return Datatables::of($data)->make(true);;
      }
        return view('admin.email.subscriber');
    }

}
