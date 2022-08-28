<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BetweenRule;
use App\Rules\BlacklistEmailRule;
use App\Rules\BlacklistDomainRule;

class JobAlertRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => ['required', new BetweenRule(2, 200)],
            'email' => ['max:100', new BlacklistEmailRule(), new BlacklistDomainRule()],
        ];
    }

}
