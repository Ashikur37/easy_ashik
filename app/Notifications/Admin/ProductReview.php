<?php

namespace App\Notifications\Admin;

use App\Model\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class ProductReview extends Notification
{
    use Queueable;
    public $productReview;
    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
      
        $this->productReview=Review::find($id);
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
        if($this->ns->admin_mail_product_review){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_product_review){
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
                    ->line($this->productReview->user->name." reviewed (".$this->productReview->comment.") on ".$this->productReview->product->name." "." at ".$this->productReview->created_at->format("g:i A d-M-y"))
                    ->action('See now', url('/product/'.$this->productReview->product->slug))
                    ->line('Thank you for using our application!');
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
            "icon"=>"rating.png",
            "title"=>"New review on product ".$this->productReview->product->name,
            "text"=>$this->productReview->user->name." reviewed ".$this->productReview->title,
            "link"=>url('/product/'.$this->productReview->product->slug),
            "created_at"=>$this->productReview->created_at,
        ];
    }
}
