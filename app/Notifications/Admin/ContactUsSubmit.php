<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class ContactUsSubmit extends Notification
{
    use Queueable;

    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
        $this->ns=NotificationSetting::first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
          $via=[];
        if($this->ns->admin_mail_contact_form){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_contact_form){
            array_push($via,'database');
        }
        return $via; 
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('New contact us submit')
                    ->line('Name: '.$this->data["name"])
                    ->line('Email: '.$this->data["email"])
                    ->line('Subject: '.$this->data["subject"])
                    ->line('Message: '.$this->data["message"]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "icon"=>"comment.png",
            "title"=>"Contact us form subject by ".$this->data["name"],
            "text"=>$this->data["subject"],
            "link"=>url('/')
        ];
    }
}
