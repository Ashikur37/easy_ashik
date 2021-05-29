<?php

namespace App\Notifications\Admin;

use App\Model\BlogCommentReply as ModelBlogCommentReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class BlogCommentReply extends Notification
{
    use Queueable;
    public $blogCommentReply;
    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->blogCommentReply=ModelBlogCommentReply::find($id);
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
            if($this->ns->admin_mail_blog_comment_reply){
                array_push($via,'mail');
            }
            if($this->ns->admin_db_blog_comment_reply){
                array_push($via,'database');
            }
        }
        else{
            if($this->ns->user_mail_blog_comment_reply){
                array_push($via,'mail');
            }
            if($this->ns->user_db_blog_comment_reply){
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
        ->line($this->blogCommentReply->user->name." Replied (".$this->blogCommentReply->text.") on comment of blog blog ".$this->blogCommentReply->blogComment->blog->title." at ".$this->blogCommentReply->created_at->format("h:i A d-M-y"))
        ->action('See now', url('/blog/'.$this->blogCommentReply->blogComment->blog->slug));
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
            "title"=>"Reply on comment of blog ".$this->blogCommentReply->blogComment->blog->title,
            "text"=>$this->blogCommentReply->user->name." reply  ".$this->blogCommentReply->blogComment->text,
            "link"=>url('/blog/'.$this->blogCommentReply->blogComment->blog->slug)
        ];
    }
}
