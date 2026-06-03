<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    protected $table = 'students';

    protected $fillable = [
        'name','email',
    ];
}
