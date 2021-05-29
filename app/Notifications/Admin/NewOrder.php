<?php

namespace App\Notifications\Admin;

use App\Model\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class NewOrder extends Notification
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
        $this->order=Order::find($id);
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
        if($this->ns->admin_mail_new_order){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_new_order){
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
        $items = unserialize(bzdecompress(utf8_decode($this->order->cart)));
        
        $message= (new MailMessage)
                    ->line('New order received from '.$this->order->customer_first_name." at ".$this->order->created_at->format("h:i A d-M-y"))->line('Order details');
                    foreach($items as $item){
                        $message = $message->line($item->name.' x '.$item->qty.'  '.\App\Model\Product::currencyPriceRate($item->subtotal));
                    }
                    $message = $message->line('Tax '.\App\Model\Product::currencyPriceRate($this->order->tax))
                    ->line('Total amount '.\App\Model\Product::currencyPriceRate($this->order->total))
                    ->action('See now', route('order.show',$this->order->id));
                return $message;
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
            "icon"=>"order.png",
            "title"=>"New order received",
            "text"=>"<b>".$this->order->customer_first_name."</b> placed an order amount of <b>".\App\Model\Product::currencyPriceRate($this->order->total)."</b>",
            "link"=>route('order.show',$this->order->id)
        ];
    }
}
