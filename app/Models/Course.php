<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $guarded = [];

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getTeacher()
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
}
