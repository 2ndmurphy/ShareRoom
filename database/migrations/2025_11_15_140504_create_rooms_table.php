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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users');
            $table->foreignId('type_id')->constrained('room_types');
            $table->string('title', 120);
            $table->text('description');
            $table->enum('mode', ['online', 'offline', 'hybrid']);
            $table->string('location', 100);
            $table->dateTime('started_at');
            $table->dateTime('end_at')->nullable();
            $table->text('requirements')->nullable();
            $table->enum('status', ['waiting', 'started', 'completed'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
