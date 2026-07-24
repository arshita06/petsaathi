<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $guarded = ['id'];

    use HasFactory, HasRole, Notifiable, softDeletes;

    public function product()
    {
        return $this->belongtoMany(Product::class, 'product_id');
    }

    public function user()
    {
        return $this ->belongaToMany(User::class, 'user_id');
    }
}
