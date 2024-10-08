<?php
// User.php (Model)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_number',
        'address',
        'role',
        'is_delete',
        'type',
        'shift',
        'sclary',
        'branch',
        'plan_id',
        'fcm_token',
        'push_notificatio',
        'profile_photo_path',
        'registration_no',
        'active',
        'tz',
        'meta',
    ];


    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_delete' => 'boolean',
        'meta' => 'array',
    ];

    /**
     * Append additional attributes to the model.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string|null
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path != null ? url(Storage::url($this->profile_photo_path)) : null;

    }
}
