<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(int[] $array)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status', 'show_at_home'];
}
