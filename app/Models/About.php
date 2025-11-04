<?php

namespace App\Models;

use Database\Factories\AboutFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    /** @use HasFactory<AboutFactory> */
    use HasFactory;

    protected $table = 'abouts';

    protected $guarded = [];
}
