<?php

namespace App\Notifications\Admin;

use App\Model\ProductComment as ModelProductComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;
use Illuminate\Support\Str;

class ProductComment extends Notification
{
    use Queueable;
    public $productComment;
    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
      
        $this->productComment=ModelProductComment::find($id);
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
        if($this->ns->admin_mail_product_comment){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_product_comment){
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
                    ->line($this->productComment->user->name." commented (".$this->productComment->text.") on ".$this->productComment->product->name." commented"." at ".$this->productComment->created_at->format("g:i A d-M-y"))
                    ->action('See now', url('/product/'.$this->productComment->product->slug));
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
            "title"=>"New comment on '".Str::limit($this->productComment->product->name,30,'..')."'",
            "text"=>"<b>".$this->productComment->user->name."</b> commented ".$this->productComment->text,
            "link"=>url('/product/'.$this->productComment->product->slug),
            "created_at"=>$this->productComment->created_at,
        ];
    }
}
