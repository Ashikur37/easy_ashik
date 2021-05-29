<?php

namespace App\Notifications\Admin;

use App\Model\Withdraw;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class UserWithdraw extends Notification
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
        $this->withdraw=Withdraw::find($id);
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
        if($this->ns->admin_mail_withdraw){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_withdraw){
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
                    ->line($this->withdraw->user->name." applied for withdraw")
                    ->line('Amount: '.\App\Model\Product::currencyPriceRate($this->withdraw->amount))
                    ->line('Payment method: '.$this->withdraw->method)
                    ->action('See Now', route('withdraw.index'));
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
            "title"=>"New withdraw application from ".$this->withdraw->user->name,
            "text"=>"Withdraw amount ".\App\Model\Product::currencyPriceRate($this->withdraw->amount)." by ".$this->withdraw->method,
            "link"=>route('withdraw.index')
           
        ];
    }
}
