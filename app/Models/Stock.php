<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperStock
 */
class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function size()
    {
        return $this->belongsTo(Size::class, "size_id", "id");
    }
}
