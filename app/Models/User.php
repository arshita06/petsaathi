<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'phone', 'address'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    protected $table = 'users';
    protected $guarded = ['id'];

    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Where this user should land after logging in.
     *
     * Customers (the "user" role, and freshly registered accounts that have no
     * role yet) go to the storefront; back-office roles go to the admin panel.
     */
    public function homeRoute(): string
    {
        $isCustomer = $this->hasRole('user') || $this->roles->isEmpty();

        return $isCustomer
            ? route('home', absolute: false)
            : route('admin.dashboard', absolute: false);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
     public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
