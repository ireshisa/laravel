<?php

namespace App\Models;

use App\Helpers\Number;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\LocalizedScope;
use App\Models\Traits\CountryTrait;
use App\Observer\CityObserver;
use Larapen\Admin\app\Models\Crud;

class JobAlert extends BaseModel {

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'period',
        'url',
        'city_id',
        'postedDate',
        'maxSalary',
        'minSalary',
        'category_id',
        'jobtypes',
        'types',
        'categories',
        'age',
        'salary',
        'experience',
        'qualifications',
        'gender',
    ];  
    
    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }
    
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function genderID() {
    return $this->belongsTo(Gender::class, 'gender');
    }


}
