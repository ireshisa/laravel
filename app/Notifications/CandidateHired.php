<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CandidateHired extends Notification
{
use Queueable;

protected $details;

public function __construct($details)
{
$this->details = $details;

}

public function via($notifiable)
{
// if (!isset($this->entityRef['name'])) {
// return false;
// }

return ['mail'];
}

public function toMail($notifiable)
{
$verificationUrl = lurl('account/meetings');

return (new MailMessage)
->subject("You have been Selected For the Post of ".$this->details->job)
->greeting('Dear '.$this->details->name)
->line("You have been selected by the employer (".$this->details->employer.") for the post of ".$this->details->job.". Please click the link below to find more details.")
->action('View Details', $verificationUrl);
}
}
