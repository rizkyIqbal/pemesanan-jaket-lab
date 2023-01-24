<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTimeline
 */
class Timeline extends Model
{
    use HasFactory;

    protected $guarded = [];
}
