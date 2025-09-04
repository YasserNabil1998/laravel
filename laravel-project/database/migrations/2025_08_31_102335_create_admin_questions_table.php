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
        Schema::create('admin_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users');
            $table->string('subject');
            $table->text('question_text');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed']);
            $table->text('answer')->nullable();
            $table->foreignId('answered_by')->nullable()->constrained('users');
            $table->datetime('answered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_questions');
    }
};
