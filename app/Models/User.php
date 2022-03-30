<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'provider',
        'provider_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add first name attribute, get from full name
     * @return string
     */
    public function getFirstNameAttribute()
    {
        $results = array();
        $name = $this->attributes['name'];
        $results = explode(' ', $name);

        return $results[0];
    }

    public function getProfilePictureAttribute()
    {
        $attributes = $this->attributes;
        $profilePicture = $attributes['profile_picture'];
        $path = 'uploads/user/'.$profilePicture;
        $url = null;
        $driver = config('filesystems.default');
        $url = asset('storage/'.$path);
        if ($driver == 's3') {
            if (Storage::disk($driver)->exists($path)) {
                $url = Storage::disk($driver)->url($path);
            } else {
                $url = null;
            }
        }
        return $url ?? asset('assets/images/dummy.png');
    }
}
