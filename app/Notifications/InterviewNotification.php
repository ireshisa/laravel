<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InterviewNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($meeting) {
        $this->meeting = $meeting;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
               if(!empty($this->meeting->details->message))
        {
            $massage1="Additional message ";
            $massage2=$this->meeting->details->message;
        }else {
            $massage1=" ";
            $massage2=" ";
        }
     
        return (new MailMessage)
                    ->subject("Interview - ".$this->meeting->subject.$this->meeting->details->title)
                    ->greeting('Hello '.$this->meeting->details->candidate->name.', ')
                    ->line('An interview has been '.$this->meeting->type.' the for the Post of '.$this->meeting->details->title.' you have applied, on '. $this->meeting->details->m_date. ' from '. $this->meeting->details->m_from. ' to '. $this->meeting->details->m_to)
                    ->line('Location '. $this->meeting->details->m_location)
                    ->line($massage1)
                    ->line($massage2)
                    ->action('Please Connect for more details', url('/'))
                    
                    ->line('Thank you for using Search Jobs');
   $msg = "Connection request sent successfully " ;
            flash($msg)->success();
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
            //
        ];
    }
}
