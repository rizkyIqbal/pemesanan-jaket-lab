<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBank
 */
class Bank extends Model
{
    use HasFactory;

    protected $guarded = [];    
}
