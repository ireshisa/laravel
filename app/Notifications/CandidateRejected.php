<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CandidateRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;

    }

    public function via($notifiable)
    {
        if (!isset($this->entityRef['name'])) {
            return false;
        }

        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = lurl('account/meetings');

        return (new MailMessage)
            ->subject("Your Application is Rejected - ".$this->details->job)
            ->greeting('Dear '.$this->details->name)
            ->line("Your application is rejected by the employer (".$this->details->employer.") for the position of ".$this->details->job." you have applied for.")
            ->line("Reason For Reject")
            ->line($this->details->message)
            ->line(" Please click the link below to find more details")
            ->action('View Details', $verificationUrl);

    }
}
