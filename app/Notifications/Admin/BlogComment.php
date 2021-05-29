<?php

namespace App\Notifications\Admin;

use App\Model\BlogComment as ModelBlogComment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class BlogComment extends Notification
{
    use Queueable;
    public $blogComment;
    public $ns;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        
        $this->blogComment=ModelBlogComment::find($id);
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
        if($this->ns->admin_mail_blog_comment){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_blog_comment){
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
                    ->line($this->blogComment->user->name." comment (".$this->blogComment->text.") on ".$this->blogComment->blog->title." post"." at ".$this->blogComment->created_at->format("g:i A d-M-y"))
                    ->action('See now', url('/blog/'.$this->blogComment->blog->slug));
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
            "title"=>"Blog comment on ".$this->blogComment->blog->title,
            "text"=>$this->blogComment->user->name." comment  ".$this->blogComment->text,
            "link"=>url('/blog/'.$this->blogComment->blog->slug)
        ];
    }
}
