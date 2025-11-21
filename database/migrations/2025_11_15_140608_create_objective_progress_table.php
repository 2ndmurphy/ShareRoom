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
        DB::statement('PRAGMA foreign_keys = ON');

        Schema::create('objective_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objective_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['not_started','in_progress','completed'])->default('not_started');
            $table->timestamps();

            $table->foreign('objective_id')->references('id')->on('room_objectives')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // ensure one progress row per (objective, user)
            $table->unique(['objective_id', 'user_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objective_progress');
    }
};
