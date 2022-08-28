<?php
//

namespace App\Http\Requests;

use App\Helpers\Files\Storage\StorageDisk;
use App\Models\Resume;
use App\Rules\BetweenRule;
use App\Rules\EmailRule;

class SendMessageRequest extends Request
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'from_name'  => ['required', new BetweenRule(2, 200)],
			'from_email' => ['max:100'],
			'from_phone' => ['max:20'],
//			'cover_letter'    => ['required', new BetweenRule(100, 10000)],
			'post_id'    => ['required', 'numeric'],
		];
		
		// reCAPTCHA
		$rules = $this->recaptchaRules($rules);

		// Check 'resume' is required
//		if (auth()->check()) {
//			$disk = StorageDisk::getDisk();
//			$resume = Resume::where('id', $this->input('resume_id'))->where('user_id', auth()->user()->id)->first();
//			if (
//				empty($resume)
//				|| trim($resume->filename) == ''
//				|| !$disk->exists($resume->filename)
//			) {
//				$rules['resume.filename'] = [
//					'required',
//					'mimes:' . getUploadFileTypes('file'),
//					'min:' . (int)config('settings.upload.min_file_size', 0),
//					'max:' . (int)config('settings.upload.max_file_size', 1000),
//				];
//			}
//		} else {
//			$rules['resume.filename'] = [
//				'required',
//				'mimes:' . getUploadFileTypes('file'),
//				'min:' . (int)config('settings.upload.min_file_size', 0),
//				'max:' . (int)config('settings.upload.max_file_size', 1000),
//			];
//		}

		// Email
		
		if ($this->filled('from_email')) {
			//$rules['from_email'][] = 'email';
			$rules['from_email'][] = new EmailRule();
		}
		
		if (isEnabledField('email')) {
			if (isEnabledField('phone') && isEnabledField('email')) {
				$rules['from_email'][] = 'required_without:from_phone';
			} else {
				$rules['from_email'][] = 'required';
			}
		}
		
		// Phone
		if (config('settings.sms.phone_verification') == 1) {
			if ($this->filled('phone')) {
				$countryCode = $this->input('country_code', config('country.code'));
				if ($countryCode == 'UK') {
					$countryCode = 'GB';
				}
				$rules['from_phone'][] = 'phone:' . $countryCode;
			}
		}
		if (isEnabledField('phone')) {
			if (isEnabledField('phone') && isEnabledField('email')) {
				$rules['from_phone'][] = 'required_without:from_email';
			} else {
				$rules['from_phone'][] = 'required';
			}
		}

		return $rules;
	}
	
	/**
	 * @return array
	 */
	public function messages()
	{
		$messages = [];
		
		return $messages;
	}
}
