<?php

namespace App\Notifications\Admin;

use App\Model\ProductCommentReply as ModelProductCommentReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class ProductCommentReply extends Notification
{
    use Queueable;
    public $productCommentReply;
    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->productCommentReply=ModelProductCommentReply::find($id);
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
        if($notifiable->type==3){
            if($this->ns->admin_mail_product_comment_reply){
                array_push($via,'mail');
            }
            if($this->ns->admin_db_product_comment_reply){
                array_push($via,'database');
            }
        }
        else{
            if($this->ns->user_mail_product_comment_reply){
                array_push($via,'mail');
            }
            if($this->ns->user_db_product_comment_reply){
                array_push($via,'database');
            }
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
        ->line($this->productCommentReply->user->name." Replied (".$this->productCommentReply->text.") on product ".$this->productCommentReply->productComment->product->name." "." at ".$this->productCommentReply->created_at->format("g:i A d-M-y"))
        ->action('See now', url('/product/'.$this->productCommentReply->productComment->product->slug));
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
            "title"=>"Product comment reply on product ".$this->productCommentReply->productComment->product->name,
            "text"=>$this->productCommentReply->user->name." reply  ".$this->productCommentReply->text,
            "link"=>url('/product/'.$this->productCommentReply->productComment->product->slug),
            "created_at"=>$this->productCommentReply->created_at,
        ];
    }
}
