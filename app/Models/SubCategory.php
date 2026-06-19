<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class SubCategory extends Model
{
    protected $table = 'subcategory';
    protected $guarded = ['id'];

     use HasFactory, HasRoles, Notifiable, SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
