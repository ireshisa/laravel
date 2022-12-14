<?php
//

namespace App\Notifications;

use App\Helpers\UrlGen;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jenssegers\Date\Date;

class PostNotification extends Notification implements ShouldQueue
{
	use Queueable;
	
	protected $post;
	
	public function __construct($post)
	{
		$this->post = $post;
	}
	
	public function via($notifiable)
	{
		return ['mail'];
	}
	
	public function toMail($notifiable)
	{
		$postUrl = UrlGen::post($this->post);
		
		return (new MailMessage)
			->subject(trans('mail.post_notification_title'))
			->greeting(trans('mail.post_notification_content_1'))
			->line(trans('mail.post_notification_content_2', ['advertiserName' => $this->post->contact_name]))
			->line(trans('mail.post_notification_content_3', [
				'postUrl' => $postUrl,
				'title'   => $this->post->title,
				'now'     => Date::now(config('timezone.id'))->formatLocalized(config('settings.app.default_date_format')),
				'time'    => Date::now(config('timezone.id'))->format('H:i'),
			]));
	}
}
