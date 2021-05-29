<?php

namespace App\Notifications\Admin;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class NewUserRegistration extends Notification
{
    use Queueable;

    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->user=User::find($id);
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
        if($this->ns->admin_mail_new_user){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_new_user){
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
                    ->line('New user registered')
                    ->line('Name: '.$this->user->name." ".$this->user->lastname)
                    ->line('Email: '.$this->user->email)
                    ->action('Customer List', route('customer.index'));
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
            "icon"=>"user.png",
            "title"=>"New user registered ",
            "text"=>$this->user->name." ".$this->user->lastname." registered with email ".$this->user->email,
            "link"=>route('customer.index')
           
        ];
    }
}
