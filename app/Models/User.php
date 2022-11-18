<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;


class User extends Authenticateable
{
    use HasFactory;
    protected $table = 't_user';
    protected $fillable = ['email', 'password', 'level', 'status_user'];
}
