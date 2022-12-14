<?php
//

namespace App\Notifications;

use App\Helpers\UrlGen;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportSent extends Notification implements ShouldQueue
{
	use Queueable;
	
	protected $post;
	protected $report;
	
	public function __construct(Post $post, $report)
	{
		$this->post = $post;
		$this->report = $report;
	}
	
	public function via($notifiable)
	{
		return ['mail'];
	}
	
	public function toMail($notifiable)
	{
		$postUrl = UrlGen::post($this->post);
		
		return (new MailMessage)
			->replyTo($this->report->email, $this->report->email)
			->subject(trans('mail.post_report_sent_title', [
				'appName'     => config('app.name'),
				'countryCode' => $this->post->country_code,
			]))
			->line(trans('mail.Post URL') . ': <a href="' . $postUrl . '">' . $postUrl . '</a>')
			->line(nl2br($this->report->message));
	}
}
