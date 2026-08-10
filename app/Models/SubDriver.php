<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDriver extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'name'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
