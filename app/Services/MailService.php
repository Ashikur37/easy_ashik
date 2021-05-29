<?php
namespace App\Services;

use App\Model\EmailSetting;
use App\Model\Subscriber;
use Mail;

class MailService
{
    public static function sendToMany($emails,$subject,$body){
        $setup = EmailSetting::find(1);
        $data = [
            'email_body' => $body
        ];
        foreach($emails as $email){
            
            $objDemo = new \stdClass();
            $objDemo->to = $email->email;
            $objDemo->from = $setup->from_email;
            $objDemo->title = $setup->from_name;
            $objDemo->subject = $subject;
    
            try{
                Mail::send('mail.body',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            }
            catch (\Exception $e){
                
            }
        }
    }
    public static function sendToManySubscriber($subject,$body){
        $setup = EmailSetting::find(1);
        $subscribers=Subscriber::all();
        $data = [
            'email_body' => $body
        ];
        foreach($subscribers as $subscriber){
            $subscriber->mail_count+=1;
            $subscriber->last_email=$subject;
            $subscriber->save();
            $objDemo = new \stdClass();
            $objDemo->to = $subscriber->email;
            $objDemo->from = $setup->from_email;
            $objDemo->title = $setup->from_name;
            $objDemo->subject = $subject;
    
            try{
                Mail::send('mail.body',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            }
            catch (\Exception $e){
                dd($e);
            }
        }
    }

}