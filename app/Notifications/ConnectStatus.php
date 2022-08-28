<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class ConnectStatus extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $details;
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
        $mail = (new MailMessage);
        $mail->greeting("Hi ".$this->details->name);
        if ($this->details->status == 1)
        {

            $mail->line('A new connection Request is received from '.$this->details->from_user.".")
                ->line("Job Title - ".$this->details->title)
                ->subject('You have received a Connection Request - '.$this->details->title);
            if ($this->details->type==2)
            {
                $mail->line("Company : ".$this->details->name2);
                $mail->line("Note: Accept the connection request only if you are interested and will attend the interview");
            }
            else {
                $mail->line("Candidate Name : ".$this->details->name2);
            }

        }
        else if ($this->details->status == 2) {
            $mail->subject("Connection Request is approved");
            $mail->line('Your connection request is approved By '.$this->details->by);
            $mail->line('Job Title : '.$this->details->title);
            if ($this->details->type==2)
            {

                $mail->line('Company : '.$this->details->name2);
            }
            else {
                $mail->line('Candidate Name : '.$this->details->name2);
            }

        }
        else if ($this->details->status == 3) {
            $mail->subject("Connection Request is Declined");
            // if ($this->details->type==2)
            // {
                $mail->line('Your connection request is declined By '.$this->details->by);
                $mail->line('Job Title : '.$this->details->title);
                $mail->line($this->details->name2);
            // }
            // else {
            //     $mail->line('Employee : '.$this->details->name2);
            // }

        }
        $mail->line("Thanks for using Search Jobs.")
            ->action("View More Details",url('/account/connected'));
        return $mail;
//        else if ($this->details->status == 2) {
//            return (new MailMessage)
//                ->line('The introduction to the notification.')
//                ->action('Notification Action', url('/'))
//                ->line('Thank you for using our application!');
//        }
//        else if ($this->details->status == 2) {
//            return (new MailMessage)
//                ->line('The introduction to the notification.')
//                ->action('Notification Action', url('/'))
//                ->line('Thank you for using our application!');
//        }


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
