<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];

    use HasFactory,HasRoles, Notifiable, SoftDeletes ;

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderItem()
    {
        return $this->hasMany(orderItem::class);
    }

}
