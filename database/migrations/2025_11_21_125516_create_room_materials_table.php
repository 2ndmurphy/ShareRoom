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

        Schema::create('room_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->string('title');
            $table->text('description')->nullable();

            // Tipe materi bisa salah satu dari: file, link, atau content
            $table->string('file_path')->nullable();
            $table->string('link_url')->nullable();
            $table->text('content')->nullable();

            // Room punya banyak materi
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_materials');
    }
};
