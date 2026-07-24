<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $guarded = ['id'];

    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this ->belongsTo(User::class, 'user_id');
    }
}
