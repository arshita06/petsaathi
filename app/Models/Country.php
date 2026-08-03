<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Country extends Model
{
    protected $table = 'countries';
    protected $guarded = ['id'] ;
    use HasFactory, HasRoles, Notifiable;

    // public function user(){
    //     return $this->belongsToOne(User::class, 'country_id');
    // }
}
