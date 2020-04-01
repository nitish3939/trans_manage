<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'user_type_id',
        'email_id',
        'mobile_number',
        'otp',
        'password',
    ];

    public function getProfilePicPathAttribute($name) {

        return $name ? asset('storage/profile_pic/' . $name) : asset("/img/no-image.jpg");
    }

    public function getAadharIdBackAttribute($name) {

        return $name ? asset('storage/aadhar/' . $name) : asset("/img/no-image.jpg");
    }

    public function getAadharIdFrontAttribute($name) {

        return $name ? asset('storage/aadhar/' . $name) : asset("/img/no-image.jpg");
    }

    public function getVoterIdAttribute($name) {

        return $name ? asset('storage/dl/' . $name) : asset("/img/no-image.jpg");
    }

    public function getEmailForPasswordReset() {
        return $this->email_id;
    }

}
