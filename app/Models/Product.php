<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail(string $produtId)
 * @method static where(int[] $array)
 */
class Product extends Model
{
    use HasFactory;

    function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
