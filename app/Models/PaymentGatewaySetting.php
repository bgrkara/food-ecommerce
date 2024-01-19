<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string, string $string1)
 */
class PaymentGatewaySetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];
}
