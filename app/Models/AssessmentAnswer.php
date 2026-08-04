<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentAnswer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assessment_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_assessment_id',
        'question_id',
        'score',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_assessment_id' => 'integer',
            'question_id' => 'integer',
            'score' => 'integer',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke sesi asesmen
     */
    public function userAssessment(): BelongsTo
    {
        return $this->belongsTo(UserAssessment::class, 'user_assessment_id');
    }

    /**
     * Relasi ke pertanyaan
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan skor aktual yang sudah memperhitungkan reverse_scoring
     */
    public function getCalculatedScoreAttribute(): int
    {
        if (!$this->relationLoaded('question') && !$this->question) {
            return $this->score;
        }

        return $this->question->calculateEffectiveScore($this->score);
    }
}
