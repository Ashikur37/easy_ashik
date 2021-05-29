<?php

namespace App\Notifications\Admin;

use App\Model\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Model\NotificationSetting;

class NewTicket extends Notification
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
        $this->ticket=Ticket::find($id);
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
        if($this->ns->admin_mail_new_ticket){
            array_push($via,'mail');
        }
        if($this->ns->admin_db_new_ticket){
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
        ->line($this->ticket->user->name." created a ticket at ".$this->ticket->created_at->format("h:i A d-M-y"))
        ->line('Subject: '.$this->ticket->subject)
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
            "title"=>"New ticket created", 
            "text"=>$this->ticket->user->name." created ticket for ".$this->ticket->subject,
            "link"=>route('ticket.index')
        ];
    }
}
