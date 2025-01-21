<?php

namespace App\Models\activity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\activity\ActivityFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_type_id',
        'name',
        'description',
        'img',
    ];

    public function activity_types()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }
}
