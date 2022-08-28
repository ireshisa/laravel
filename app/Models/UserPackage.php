<?php


namespace App\Models;


class UserPackage extends BaseModel
{
protected $table = "user_packages";
public $timestamps= true;

public function package()
{
    $this->hasOne(Package::class,'package_id');
}

    public function getExpiryDateAttribute($value)
    {

        return ucfirst(date('d-m-Y H:i:s',strtotime($value)));
    }
}