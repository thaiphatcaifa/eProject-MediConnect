<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'city_id', // Add this
        'phone',   // Add this
        'address', // Add this
        'avatar',  // Add this
    ];
    protected $hidden = ['password', 'remember_token'];
    public function doctor() { return $this->hasOne(Doctor::class); }
}