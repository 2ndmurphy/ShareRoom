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

        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            // mentor bisa di-set null jika user dihapus / dinonaktifkan
            $table->unsignedBigInteger('mentor_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('mode', ['online','offline','hybrid'])->default('online');
            $table->string('location')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->text('requirements')->nullable();
            $table->enum('status', ['waiting','started','ended'])->default('waiting');
            $table->timestamps();
            $table->softDeletes();

            // foreign keys
            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('room_types')->onDelete('set null');

            $table->index(['mentor_id']);
            $table->index(['type_id']);
            $table->index(['status']);
            $table->index(['started_at']);
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
