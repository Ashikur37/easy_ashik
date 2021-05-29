<?php

namespace App\Jobs;

use App\Model\EmailSetting;
use App\Model\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $subject,$body;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subject,$body)
    {
        $this->subject = $subject;
        $this->body = $body;
        

    }
   
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $setup = EmailSetting::find(1);
        $subscribers=Subscriber::all();
        $data = [
            'email_body' => $this->body
        ];
        foreach($subscribers as $subscriber){
            $subscriber->mail_count+=1;
            $subscriber->last_email=$this->subject;
            $subscriber->save();
            $objDemo = new \stdClass();
            $objDemo->to = $subscriber->email;
            $objDemo->from = $setup->from_email;
            $objDemo->title = $setup->from_name;
            $objDemo->subject = $this->subject;
    
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
}
