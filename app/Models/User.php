<?php
//

namespace App\Models;

use App\Helpers\Files\Storage\StorageDisk;
use App\Models\Scopes\LocalizedScope;
use App\Models\Scopes\VerifiedScope;
use App\Models\Traits\CountryTrait;
use App\Notifications\ResetPasswordNotification;
use App\Observer\UserObserver;
use App\Models\SaveCandidate;
use App\Models\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jenssegers\Date\Date;
use Larapen\Admin\app\Models\Crud;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseUser
{
	use Crud, HasRoles, CountryTrait, HasApiTokens, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';
    protected $appends = ['created_at_ta'];
    
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
    protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_code',
		'language_code',
        'user_type_id',
        'gender_id',
        'firstname',
        'lastname',
        'name',
		'photo',
        'about',
        'phone',
        'phone_hidden',
        'email',
        'password',
        'remember_token',
        'is_admin',
		'can_be_impersonate',
        'disable_comments',
        'receive_newsletter',
        'receive_advice',
        'ip_addr',
        'provider',
        'provider_id',
		'email_token',
		'phone_token',
		'verified_email',
		'verified_phone',
        'blocked',
        'closed',
        'extra_educations',
        'extra_experiences',
        'extra_skills',
        'sector_id',
        'city_id',
        'post_type_id',
        'experience',
        
    ];
    
    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'last_login_at', 'deleted_at'];
	
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'extra_educations'=>'array',
        'extra_experiences'=>'array',
        'extra_skills'=>'array',
        'acheivements'=>'array',
        'referees'=>'array',
        'social_links'=>'array',
	];
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
	
		User::observe(UserObserver::class);
    
        // Don't apply the ActiveScope when:
        // - User forgot its Password
        // - User changes its Email or Phone
        if (
            !Str::contains(Route::currentRouteAction(), 'Auth\ForgotPasswordController') &&
            !Str::contains(Route::currentRouteAction(), 'Auth\ResetPasswordController') &&
            !session()->has('emailOrPhoneChanged') &&
			!Str::contains(Route::currentRouteAction(), 'Impersonate\Controllers\ImpersonateController')
        ) {
            static::addGlobalScope(new VerifiedScope());
        }
		static::addGlobalScope(new LocalizedScope());
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function routeNotificationForNexmo()
    {
		$phone = phoneFormatInt($this->phone, $this->country_code);
		$phone = setPhoneSign($phone, 'nexmo');
	
		return $phone;
    }

    public function routeNotificationForTwilio()
    {
        $phone = phoneFormatInt($this->phone, $this->country_code);
		$phone = setPhoneSign($phone, 'twilio');
        
        return $phone;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        if (request()->filled('email') || request()->filled('phone')) {
            if (request()->filled('email')) {
                $field = 'email';
            } else {
                $field = 'phone';
            }
        } else {
            if (!empty($this->email)) {
                $field = 'email';
            } else {
                $field = 'phone';
            }
        }

        try {
            $this->notify(new ResetPasswordNotification($this, $token, $field));
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
    }
	
	/**
	 * @return bool
	 */
	public function canImpersonate()
	{
		// Cannot impersonate from Demo website,
		// Non admin users cannot impersonate
		if (isDemo() || !$this->can(Permission::getStaffPermissions())) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * @return bool
	 */
	public function canBeImpersonated()
	{
		// Cannot be impersonated from Demo website,
		// Admin users cannot be impersonated,
		// Users with the 'can_be_impersonated' attribute != 1 cannot be impersonated
		if (isDemo() || $this->can(Permission::getStaffPermissions()) || $this->can_be_impersonated != 1) {
			return false;
		}
		
		return true;
	}
	
	public function impersonateBtn($xPanel = false)
	{
		// Get all the User's attributes
		$user = self::findOrFail($this->getKey());
		
		// Get impersonate URL
		// $impersonateUrl = route('impersonate', $this->getKey());
		$impersonateUrl = localUrl($this->country_code, 'impersonate/take/' . $this->getKey(), false, false);
		
		// If the Domain Mapping plugin is installed,
		// Then, the impersonate feature need to be disabled
		if (config('plugins.domainmapping.installed')) {
			return null;
		}
		
		// Generate the impersonate link
		$out = '';
		if ($user->getKey() == auth()->user()->getAuthIdentifier()) {
			$tooltip = '" data-toggle="tooltip" title="' . t('Cannot impersonate yourself') . '"';
			$out .= '<a class="btn btn-xs btn-warning" ' . $tooltip . '><i class="fa fa-btn fa-lock"></i></a>';
		} else if ($user->can(Permission::getStaffPermissions())) {
			$tooltip = '" data-toggle="tooltip" title="' . t('Cannot impersonate admin users') . '"';
			$out .= '<a class="btn btn-xs btn-warning" ' . $tooltip . '><i class="fa fa-btn fa-lock"></i></a>';
		} else if (!isVerifiedUser($user)) {
			$tooltip = '" data-toggle="tooltip" title="' . t('Cannot impersonate unactivated users') . '"';
			$out .= '<a class="btn btn-xs btn-warning" ' . $tooltip . '><i class="fa fa-btn fa-lock"></i></a>';
		} else {
			$tooltip = '" data-toggle="tooltip" title="' . t('Impersonate this user') . '"';
			$out .= '<a class="btn btn-xs btn-default" href="' . $impersonateUrl . '" ' . $tooltip . '><i class="fa fa-btn fa-sign-in"></i></a>';
		}
		
		return $out;
	}
	
	public function deleteBtn($xPanel = false)
	{
		if (auth()->check()) {
			if ($this->id == auth()->user()->id) {
				return null;
			}
			if (isDemoDomain() && $this->id == 1) {
				return null;
			}
		}
		
		$url = admin_url('users/' . $this->id);
		
		$out = '';
		$out .= '<a href="' . $url . '" class="btn btn-xs btn-danger" data-button-type="delete">';
		$out .= '<i class="fa fa-trash"></i> ';
		$out .= trans('admin::messages.delete');
		$out .= '</a>';
		
		return $out;
	}

    public function getAverageReviewRate()
    {
        return !$this->reviews->isEmpty() ? $this->reviews->average('rating') : 0;
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id')->orderBy('id', 'DESC');
    }
    
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'translation_of')->where('translation_lang', config('app.locale'));
    }
    
    public function messages()
    {
        return $this->hasManyThrough(Message::class, Post::class, 'user_id', 'post_id');
    }
    
    public function messagesConnectedApproved($user_id)
    {
       $connected = Message::with('latestReply')
                ->byUserId(auth()->user()->id)
                ->where('parent_id', 0)
                ->where('is_approved', 1)
                ->where('to_user_id',$user_id)
                ->where('subject', "LIKE", "New Connection request")
                ->orderByDesc('id')->get();
        return $connected;
    }
    
    public function savedPosts()
    {
        return $this->belongsToMany(Post::class, 'saved_posts', 'user_id', 'post_id');
    }
    
    public function savedCandidates()
    {
        return $this->hasMany(SaveCandidate::class,  'user_id');
    }
    
    public function savedSearch()
    {
        return $this->hasMany(SavedSearch::class, 'user_id');
    }
    
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function sector()
    {
        return $this->belongsTo(Category::class, 'sector_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class, 'post_type_id', 'translation_of')->where('translation_lang', config('app.locale'));
    }

    public function followingCompanies() {
        return $this->hasMany(CompanyFollower::class, 'user_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function myReviews() {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function endorsements() {
        return $this->hasMany(Endorsement::class, 'user_id');
    }

    public function jobAlerts() {
        return $this->hasMany(JobAlert::class, 'user_id');
    }

    public function coverLetters() {
        return $this->hasMany(Cover::class, 'user_id')->limit(4);
    }

    public function myCompaniesFollowers() {
        return $this->hasManyThrough(CompanyFollower::class, Company::class, 'user_id', 'company_id');
    }

    public function myCompaniesPosts() {
        return $this->hasManyThrough(Post::class, Company::class, 'user_id', 'company_id');
    }

    public function purchasedPackage() {
        return $this->belongsToMany(Package::class,'user_packages','user_id','package_id')->withPivot('expiry_date','available_connects');
    }

    public function orders() {
        return $this->belongsToMany(Package::class,'user_payments','user_id','package_id')->withPivot('payment_ref','updated_at');
    }

    public function meetings() {
        return $this->hasMany(Meetings::class,'my_id','id');
    }
    public  function myCompanies()
    {
        return $this->hasMany(Company::class);
    }

    public function userReview()
    {
        return $this->hasMany(Review::class,'reviewer_id');
    }

    public function myCoverLetter()
    {
        return $this->hasOne(UserCoverLetter::class,'user_id');
    }

    public function userPackage()
    {
        return $this->hasOne(UserPackage::class);
    }
    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeVerified($builder)
    {
        $builder->where(function($query) {
            $query->where('verified_email', 1)->where('verified_phone', 1);
        });
        
        return $builder;
    }
    
    public function scopeUnverified($builder)
    {
        $builder->where(function($query) {
            $query->where('verified_email', 0)->orWhere('verified_phone', 0);
        });
        
        return $builder;
    }
    
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getCreatedAtAttribute($value)
    {
        $value = Date::parse($value);
        if (config('timezone.id')) {
            $value->timezone(config('timezone.id'));
        }
        // echo $value->format('l d F Y H:i:s').'<hr>'; exit();
        // echo $value->formatLocalized('%A %d %B %Y %H:%M').'<hr>'; exit(); // Multi-language

        return $value;
    }
    
    public function getUpdatedAtAttribute($value)
    {
        $value = Date::parse($value);
        if (config('timezone.id')) {
            $value->timezone(config('timezone.id'));
        }

        return $value;
    }
    
    public function getLastLoginAtAttribute($value)
    {
        $value = Date::parse($value);
        if (config('timezone.id')) {
            $value->timezone(config('timezone.id'));
        }

        return $value;
    }
    
    public function getDeletedAtAttribute($value)
    {
        $value = Date::parse($value);
        if (config('timezone.id')) {
            $value->timezone(config('timezone.id'));
        }

        return $value;
    }
    
    public function getCreatedAtTaAttribute($value)
    {
        if (!isset($this->attributes['created_at']) and is_null($this->attributes['created_at'])) {
            return null;
        }
        
        $value = Date::parse($this->attributes['created_at']);
        if (config('timezone.id')) {
            $value->timezone(config('timezone.id'));
        }
        $value = $value->ago();

        return $value;
    }
	
	public function getEmailAttribute($value)
	{
		if (isFromAdminPanel() || (!isFromAdminPanel() && in_array(request()->method(), ['GET']))) {
			if (
				isDemo() &&
				request()->segment(2) != 'password'
			) {
				if (auth()->check()) {
					if (auth()->user()->id != 1) {
						$value = hidePartOfEmail($value);
					}
				}
			}
		}
		
		return $value;
	}
    
    public function getPhoneAttribute($value)
    {
        $countryCode = config('country.code');
        if (isset($this->country_code) && !empty($this->country_code)) {
            $countryCode = $this->country_code;
        }
        
        $value = phoneFormatInt($value, $countryCode);
        
        return $value;
    }
	
	public function getNameAttribute($value)
	{
		$value = mb_ucwords($value);
		
		return $value;
	}
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
	public function setPhotoAttribute($value)
	{
		$disk = StorageDisk::getDisk();
		$attribute_name = 'photo';
		
		// Path
		$destination_path = 'avatars/' . strtolower($this->country_code) . '/' . $this->id;
		
		// If the image was erased
		if (empty($value)) {
			// delete the image from disk
			$disk->delete($this->{$attribute_name});
			
			// set null in the database column
			$this->attributes[$attribute_name] = null;
			
			return false;
		}
		
		// Check the image file
		if ($value == url('/')) {
			$this->attributes[$attribute_name] = null;
			
			return false;
		}
		
		// If laravel request->file('filename') resource OR base64 was sent, store it in the db
		try {
			if (fileIsUploaded($value)) {
				// Remove all the current user's photos, by removing his photo directory.
				$disk->deleteDirectory($destination_path);
				
				// Get file extension
				$extension = getUploadedFileExtension($value);
				if (empty($extension)) {
					$extension = 'jpg';
				}
				
				// Image quality
				$imageQuality = config('settings.upload.image_quality', 90);
				
				// Image default sizes
				$width = (int)config('settings.upload.img_resize_width', 1000);
				$height = (int)config('settings.upload.img_resize_height', 1000);
				
				// Other parameters
				$ratio = config('settings.upload.img_resize_ratio', '1');
				$upSize = config('settings.upload.img_resize_upsize', '0');
				
				// Make the image
				if (exifExtIsEnabled()) {
					$image = Image::make($value)->orientate()->resize($width, $height, function ($constraint) use ($ratio, $upSize) {
						if ($ratio == '1') {
							$constraint->aspectRatio();
						}
						if ($upSize == '1') {
							$constraint->upsize();
						}
					})->encode($extension, $imageQuality);
				} else {
					$image = Image::make($value)->resize($width, $height, function ($constraint) use ($ratio, $upSize) {
						if ($ratio == '1') {
							$constraint->aspectRatio();
						}
						if ($upSize == '1') {
							$constraint->upsize();
						}
					})->encode($extension, $imageQuality);
				}
				
				// Generate a filename.
				$filename = md5($value . time()) . '.' . $extension;
				
				// Store the image on disk.
				$disk->put($destination_path . '/' . $filename, $image->stream()->__toString());
				
				// Save the path to the database
				$this->attributes[$attribute_name] = $destination_path . '/' . $filename;
			} else {
				// Retrieve current value without upload a new file.
				if (Str::startsWith($value, config('larapen.core.picture.default'))) {
					$value = null;
				} else {
					if (!Str::startsWith($value, 'avatars/')) {
						$value = $destination_path . last(explode($destination_path, $value));
					}
				}
				$this->attributes[$attribute_name] = $value;
			}
		} catch (\Exception $e) {
			flash($e->getMessage())->error();
			$this->attributes[$attribute_name] = null;
			
			return false;
		}
	}
}
