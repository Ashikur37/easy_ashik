<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class UserAffiliation extends Notification
{
    use Queueable;

    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($balance)
    {
        $this->balance=$balance;
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
        if($this->ns->user_mail_balance_update){
            array_push($via,'mail');
        }
        if($this->ns->user_db_balance_update){
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
                ->line('You have been received affiliate balance '.\App\Model\Product::currencyPriceRate($this->balance))
                ->action('See detaild', route('user.affiliation'));
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
            "icon"=>"withdraw.png",
            "title"=>"Blance updated", 
            "text"=>'You have been received affiliate balance '.\App\Model\Product::currencyPriceRate($this->balance),
            "link"=>route('user.affiliation')
        ];
    }
}
