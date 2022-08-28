<?php


namespace App\Models;


use App\Models\Scopes\ActiveScope;
use Larapen\Admin\app\Models\Crud;

class Testimonial extends BaseModel
{
    use Crud;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimonials';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'slug'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'subtitle', 'type_id', 'description', 'name','position','company'];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }
}