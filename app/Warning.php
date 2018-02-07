<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $city
 */
class Warning extends Model
{
    protected $fillable = [
        'city',
    ];
}
