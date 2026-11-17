<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    protected $table = 'category';
    protected $guarded = ['id'];

    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
