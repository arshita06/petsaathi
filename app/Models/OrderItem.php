<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'Order_items';
    protected $guarded = ['id'];

    use Notifiable, HasFactory, HasRoles;

    public function order()
    {
        return $this->belongsTo(order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
