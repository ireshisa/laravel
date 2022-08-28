<?php

namespace App\Models;

use App\Helpers\Number;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\LocalizedScope;
use App\Models\Traits\CountryTrait;
use App\Observer\CityObserver;
use Larapen\Admin\app\Models\Crud;

class Review extends BaseModel {

    protected $fillable = [
        'user_id',
        'reviewer_id',
        'rating',
        'comment',
        'status'
    ];

    public function reviewer() {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function report() {
        return $this->hasOne(ReportReview::class, 'review_id');
    }


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
