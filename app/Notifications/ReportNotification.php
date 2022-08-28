<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReportNotification extends Notification
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
        return (new MailMessage)
            ->subject('Report Candidate No Show- '.$this->meeting->title)
            ->line('Hello,')
            ->line("I (".$this->meeting->employer_name.") would like to claim A CONNECT, since the Candidate(".$this->meeting->candidate_name.") wasn't attended the interview which had been scheduled  on ". $this->meeting->date. " for the Post of ".$this->meeting->post_title.".")
            ->line("My Comments")
            ->line($this->meeting->comments)
            ->line("Please do the needful on this and looking forward to hear from you on this")
            ->action('View Reports-No Show', url('/admin/no-show'));

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
