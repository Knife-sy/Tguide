<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar','phone',
    ];
}
