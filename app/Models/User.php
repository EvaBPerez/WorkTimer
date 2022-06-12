<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'type', 'photo'
    ];
    protected $table = 'user';
}
