<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'industry',
        'code',
        'quota',
        'report_visibility',
        'client_can_view_reports',
        'is_active',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'client_can_view_reports' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assessments()
    {
        return $this->hasMany(UserAssessment::class);
    }
}
