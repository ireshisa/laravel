<?php


namespace App\Models;


use phpseclib\Crypt\Base;

class UserPayment extends BaseModel
{
    protected $table = 'user_payments';
    public $timestamps = true;
    protected $fillable = ['user_id', 'package_id', 'payment_method_id', 'payment_ref'];

    protected static function boot()
    {
        parent::boot();
    }
    public function package()
    {
       return $this->belongsTo(Package::class,'package_id');
    }

}

