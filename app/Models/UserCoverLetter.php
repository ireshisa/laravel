<?php
namespace App\Models;
use App\Models\BaseModel;
use App\Models\Package;

class UserCoverLetter extends BaseModel
{
    protected $table = "user_coverletters";
    public $timestamps= true;
    protected $fillable = ['cover_letter'];

    protected static function boot()
    {
        parent::boot();
    }
    public function package()
    {
        $this->hasOne(Package::class,'package_id');
    }

    public function getExpiryDateAttribute($value)
    {

        return ucfirst(date('d-m-Y H:i:s',strtotime($value)));
    }
}