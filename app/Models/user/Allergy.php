<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $table = 'allergies';
    protected $fillable = [
        'name'
    ];
}
