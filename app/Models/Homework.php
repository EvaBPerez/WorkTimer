<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Homework extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name', 'color', 'user_id', 'project_id', 'time_improduct', 'time_product', 'count', 'total_time'
    ];
    protected $table = 'homework';
}
