<?php

namespace App\Models;

use Database\Factories\SubscribeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    /** @use HasFactory<SubscribeFactory> */
    use HasFactory;

    protected $table = 'subscribes';

    protected $guarded = [];
}
