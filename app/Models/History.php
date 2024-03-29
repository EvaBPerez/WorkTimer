<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class History extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'time', 'productivity', 'user_id', 'project_id', 'homework_id'
    ];
    protected $table = 'history';
}
