<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserAssessment extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Nama tabel di database
     *
     * @var string
     */
    protected $table = 'user_assessments';

    /**
     * Relasi ke grup
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Kolom yang dapat diisi secara mass-assignment
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'group_id',
        'name',
        'email',
        'dob',
        'job',
        'gender',
        'phone',
        'position',
        'security_score',
        'significance_score',
        'connection_score',
        'growth_score',
        'contribution_score',
        'archetype_name',
        'ai_narasi',
        'duration_seconds',
    ];

    /**
     * Tipe data casting
     *
     * @var array<string, string>
     */
    protected $casts = [
        'security_score'     => 'float',
        'significance_score' => 'float',
        'connection_score'   => 'float',
        'growth_score'       => 'float',
        'contribution_score' => 'float',
        'ai_narasi'          => 'array',
    ];

    /**
     * Helper accessor untuk mengambil seluruh skor dalam bentuk array asosiatif
     *
     * @return array<string, float>
     */
    public function getScoresAttribute(): array
    {
        return [
            'Security'     => (float) $this->security_score,
            'Significance' => (float) $this->significance_score,
            'Connection'   => (float) $this->connection_score,
            'Growth'       => (float) $this->growth_score,
            'Contribution' => (float) $this->contribution_score,
        ];
    }
}
