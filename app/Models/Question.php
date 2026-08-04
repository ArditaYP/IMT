<?php

namespace App\Models;

use App\Enums\DriverType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_text',
        'driver',
        'reverse_scoring',
        'order',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'driver' => DriverType::class,
            'reverse_scoring' => 'boolean',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke semua jawaban yang merujuk pada pertanyaan ini
     */
    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class, 'question_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope pertanyaan yang aktif dan diurutkan
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order', 'asc');
    }

    /**
     * Scope filter berdasarkan driver tertentu
     */
    public function scopeByDriver(Builder $query, DriverType|string $driver): Builder
    {
        $driverValue = $driver instanceof DriverType ? $driver->value : $driver;
        return $query->where('driver', $driverValue);
    }

    /*
    |--------------------------------------------------------------------------
    | BUSINESS LOGIC / HELPERS
    |--------------------------------------------------------------------------
    */

    /**
     * Menghitung nilai skor efektif berdasarkan konfigurasi reverse_scoring.
     * Contoh skala 1-5: Jika reverse, 1 menjadi 5, 2 menjadi 4, dst.
     */
    public function calculateEffectiveScore(int $rawScore, int $maxScale = 5): int
    {
        if ($this->reverse_scoring) {
            return ($maxScale + 1) - $rawScore;
        }

        return $rawScore;
    }
}
