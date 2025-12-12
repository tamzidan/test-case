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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Relasi ke Project
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            // Relasi ke User (Staff yg mengerjakan)
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->string('status')->default('pending'); // Opsional: pending, in_progress, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
