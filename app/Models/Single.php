<?php

namespace App\Models;

use Database\Factories\SingleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    /** @use HasFactory<SingleFactory> */
    use HasFactory;

    protected $table = 'singles';

    protected $guarded = [];
}
