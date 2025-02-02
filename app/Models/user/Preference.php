<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preferences';
    protected $fillable = [
        'name',
        'type'
    ];
}
