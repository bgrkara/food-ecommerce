<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail(string $id)
 */
class Address extends Model
{
    use HasFactory;

    function deliveryArea() : BelongsTo
    {
        return $this->belongsTo(DeliveryArea::class);
    }

}
