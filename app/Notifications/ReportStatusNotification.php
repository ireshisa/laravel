<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReportStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details) {
        $this->meeting = $details;
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
        if ($this->meeting->status_id == 1)
        {
            return (new MailMessage)
                ->subject('A CONNECT has been added to your package - '.$this->meeting->title)
                ->line('Dear ,'.$this->meeting->employer_name)
                ->line('We reviewed your CONNECT claim request for the candidate ('.$this->meeting->candidate_name.') who didn\'t attend the interview on '.$this->meeting->date.', and our team has increased your package\'s CONNECTS by one' )
                ->line("You can check your package details to view the available connects");
        }
        else {
            return (new MailMessage)
                ->subject('Your No-Show Request is Rejected - '.$this->meeting->title)
                ->line('Dear ,'.$this->meeting->employer_name)
                ->line('We reviewed your CONNECT claim request for the candidate ('.$this->meeting->candidate_name.') who didn\'t attend the interview on '.$this->meeting->date.', and our team decided to revoke this request after discussing with our team' );

        }

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
