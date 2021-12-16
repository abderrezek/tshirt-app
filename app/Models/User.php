<?php

namespace App\Models;

use App\Notifications\Auth\QueuedResetPassword;
use App\Notifications\Auth\QueuedVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'wilaya',
        'commune',
        'address',
        'phone',
        'role',
    ];

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
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role' => 'client',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        // $delay = now()->addMinutes(5);
        // $this->notify((new QueuedVerifyEmail())->delay($delay));

        $this->notify(new QueuedVerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        // $delay = now()->addMinutes(5);
        // $this->notify((new QueuedResetPassword())->delay($delay));

        $this->notify(new QueuedResetPassword($token));
    }

    public function isAdmin()
    {
        return $this->role === 'administrateur';
    }
}
