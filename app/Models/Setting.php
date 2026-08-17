<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory,HasRoles, Notifiable, SoftDeletes ;

    protected $table = 'settings';
    protected $guarded = ['id'];

}
