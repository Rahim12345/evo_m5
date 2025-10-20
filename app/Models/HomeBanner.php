<?php

namespace App\Models;

use Database\Factories\HomeBannerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    /** @use HasFactory<HomeBannerFactory> */
    use HasFactory;

    protected $table = 'home_banners';

    protected $guarded = [];
}
