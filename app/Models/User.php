<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Models\UserType;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    const REMEMBER_TOKEN    =   'rememberToken';
    const CREATED_AT        =   'createdAt';
    const UPDATED_AT        =   'updatedAt';
    const SESSION_ID        =   'sessionId';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'rememberToken',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'emailVerifiedAt' => 'datetime',
    ];

    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'userTypeId', 'id');
    }

    public function isAdmin()
    {
        if ($this->user_type->role == 'Administrator') {
            return true;
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if ($this->user_type->role == $role) {
            return true;
        }
        return false;
    }
}
