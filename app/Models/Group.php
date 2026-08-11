<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'start_time',
        'end_time',
        'quota',
        'is_active',
        'report_visibility',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'quota' => 'integer',
        'is_active' => 'boolean',
    ];

    public function assessments()
    {
        return $this->hasMany(UserAssessment::class);
    }
}
