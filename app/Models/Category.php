<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable =[
        'name','image',
    ];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
