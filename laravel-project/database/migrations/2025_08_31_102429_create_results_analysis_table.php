<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results_analysis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->integer('total_students');
            $table->integer('passed_students');
            $table->integer('failed_students');
            $table->decimal('average_score', 5, 2);
            $table->decimal('highest_score', 5, 2);
            $table->decimal('lowest_score', 5, 2);
            $table->json('score_distribution')->nullable();
            $table->json('question_analysis')->nullable();
            $table->datetime('analysis_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results_analysis');
    }
};
