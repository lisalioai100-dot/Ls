<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table ='lessons';

    protected $fillable =[
        'name','video','image','category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
