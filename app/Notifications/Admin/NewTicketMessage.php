<?php

namespace App\Notifications\Admin;

use App\Model\TicketMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class NewTicketMessage extends Notification
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
        if($this->ns->admin_mail_ticket_reply){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_ticket_reply){
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
        ->line($this->message->user->name." send message on ticket at ".$this->message->created_at->format("h:i A d-M-y"))
        ->line('Message: '.$this->message->message)
        ->action('See now', route('ticket.index'));
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
            "title"=>"New ticket message", 
            "text"=>$this->message->user->name." send message (".$this->message->message.")",
            "link"=>route('ticket.index')
        ];
    }
}
