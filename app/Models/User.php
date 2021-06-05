<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'role',
        'state',
        'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
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
    ];

    public function rolesToPersian(){
        if($this->role==='user'){
            return 'کاربر عادی';
        }else if($this->role==='admin'){
            return 'مدیر';
        }else if($this->role==='author'){
            return 'نویسنده';
        }
    }
    public function getShamsyDate(){
        return verta($this->created_at)->format("Y/m/d-h:i");
    }

    public function getProfileImage(){
        return asset('images/profile/'.$this->profile);
    }
}
