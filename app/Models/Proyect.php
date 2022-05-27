<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proyect extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name', 'color', 'user_id'
    ];
    protected $table = 'proyect';
}
