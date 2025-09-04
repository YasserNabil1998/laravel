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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['bug', 'feature_request', 'general', 'other']);
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed']);
            $table->text('resolution')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->datetime('resolved_at')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
