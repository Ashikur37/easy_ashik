<?php

namespace App\Notifications\User;

use App\Model\TicketMessage;
use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class TicketReply extends Notification
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
        $this->message=TicketMessage::find($id);
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
        if($this->ns->user_mail_ticket_reply){ 
            array_push($via,'mail');
        }
        if($this->ns->user_mail_ticket_reply){
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
        ->line("You have a new message on ticket ".$this->message->ticket->subject)
        ->line('Message: '.$this->message->message)
        ->line('Sent at '.$this->message->created_at->format("h:i A d-M-y"))
        ->action('See now', route('user.ticket'));
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
            "icon"=>"ticket.png",
            "title"=>"New ticket reply", 
            "text"=>$this->message->message,
            "link"=>route('user.ticket') 
        ];
    }
}
