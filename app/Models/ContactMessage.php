<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $guarded = ['id'];

    protected $casts = [
        'subscribed' => 'boolean',
        'is_read' => 'boolean',
    ];
}
