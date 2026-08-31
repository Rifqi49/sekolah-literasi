<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug');

            $table->text('description')->nullable();
            $table->longText('content')->nullable();

            $table->string('video_url')->nullable();
            $table->string('attachment')->nullable();

            $table->unsignedInteger('order')->default(0);
            $table->unsignedInteger('duration')->nullable();

            $table->timestamps();

            $table->unique(['course_id', 'slug']);
            $table->index(['course_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};