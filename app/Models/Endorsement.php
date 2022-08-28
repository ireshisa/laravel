<?php

namespace App\Models;

use App\Helpers\Number;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\LocalizedScope;
use App\Models\Traits\CountryTrait;
use App\Observer\CityObserver;
use Larapen\Admin\app\Models\Crud;

class Endorsement extends BaseModel {

    protected $fillable = [
        'user_id',
        'endorser_id',
    ];

    public function endorser() {
        return $this->belongsTo(User::class, 'endorser_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
