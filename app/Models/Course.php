<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'instructor',
        'level',
        'duration',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'duration' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)
            ->orderBy('order');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function isAvailable(): bool
    {
        return $this->is_active
            && $this->registered_count < $this->quota;
    }
}