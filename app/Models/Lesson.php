<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'description',
        'content',
        'video_url',
        'attachment',
        'order',
        'duration',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
            'duration' => 'integer',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }
}