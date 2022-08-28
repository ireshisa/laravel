<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReportReview extends Notification
{
    use Queueable;
    public $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
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
        if ($this->details->type == 1)
        {
            return (new MailMessage)
                ->subject($this->details->subject)
                ->greeting("Hi ".$this->details->name)
                ->line("Your Report on the Review (".$this->details->review.") has been approved By our team. The reported review will be no longer available on your profile.");
               // ->action('Notification Action', url('/'))
              //  ->line('Thank you for using our application!');
        }
        else {
            return (new MailMessage)
                ->subject($this->details->subject)
                ->greeting("Hi ".$this->details->name)
                ->line("Your Report on the Review (".$this->details->review.") has been declined by our team. Please find the reason below")
            ->line("Reason")
            ->line($this->details->reason);
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
