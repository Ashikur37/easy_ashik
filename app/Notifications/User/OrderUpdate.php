<?php

namespace App\Notifications\User;

use App\Model\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class OrderUpdate extends Notification
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
        if($this->ns->user_mail_order_update){
            array_push($via,'mail');
        }
        if($this->ns->user_db_order_update){
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
                    ->line('Your order has been updated at'.$this->order->updated_at->format("h:i A d-M-y"))
                    ->line('Current status: '.$this->order->statusText())
                    ->line('Payment status: '.$this->order->paymentStatusText())
                    ->line('Order details ');
                    foreach($items as $item){
                        $message = $message->line($item->name.' x '.$item->qty.'  '.\App\Model\Product::currencyPriceRate($item->subtotal));
                    }
                    $message = $message->line('Tax '.\App\Model\Product::currencyPriceRate($this->order->tax))
                    ->line('Total amount '.\App\Model\Product::currencyPriceRate($this->order->total))
                    ->action('See now', route('user.order.show',$this->order->order_number))
                    ->line('Thank you for using our application!'); 
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
            "title"=>"Order updated", 
            "text"=>'Your order has been updated at '.$this->order->updated_at->format("h:i A d-M-y"),
            "link"=>route('user.order.show',$this->order->order_number)
        ];
    }
}
