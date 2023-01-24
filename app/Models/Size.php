<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSize
 */
class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stock()
    {
        return $this->hasMany(Stock::class, "size_id", "id");
    }
}
