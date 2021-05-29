<?php

namespace App\Notifications\User;

use App\Model\TicketMessage;
use App\Model\Withdraw;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class WithdrawUpdate extends Notification
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
        if($this->ns->user_mail_withdraw_update){
            array_push($via,'mail');
        }
        if($this->ns->user_db_withdraw_update){
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
        ->line("Your withdraw of amount ".\App\Model\Product::currencyPriceRate($this->withdraw->amount)." has been updated")
        ->line('Payment method: '.$this->withdraw->method)
        ->line('updated at: '.$this->withdraw->updated_at->format("g:i A d-M-y"))
        ->action('See Now', route('user.withdraw'));
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
            "title"=>"Withdraw update", 
            "text"=>"Your withdraw of amount ".\App\Model\Product::currencyPriceRate($this->withdraw->amount)." has been updated",
            "link"=>route('user.withdraw')
        ];
    }
}
