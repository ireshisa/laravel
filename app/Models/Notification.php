<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";
    protected $fillable = ["to_user_id","notification","created_by","is_read","type","is_read","url"];

}
