<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = ['id'];

    use HasFactory, HasRoles, Notifiable;

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
