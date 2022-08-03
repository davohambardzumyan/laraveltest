<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Mail\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string first_name
 * @property string last_name
 * @property string email
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRole::class
    ];

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email, $this->first_name)->send(new ResetPassword($token, $this->email));
    }

    /**
     * @return bool
     */
    public function twoFactorAuthEnabled(): bool
    {
        return !is_null($this->two_factor_secret);
    }

    public function isAdmin()
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isUser()
    {
        return $this->role === UserRole::USER;
    }

    public function ticketsCreatedByMe()
    {
        return $this->hasMany(Ticket::class, 'creator_id', 'id');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
