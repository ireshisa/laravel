<?php

namespace App\Models;

use App\Helpers\Number;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\LocalizedScope;
use App\Models\Traits\CountryTrait;
use App\Observer\CityObserver;
use Larapen\Admin\app\Models\Crud;

class CompanyFollower extends BaseModel {
    
    protected $fillable = [
        'user_id',
        'company_id',
    ];

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
    public function follower() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
