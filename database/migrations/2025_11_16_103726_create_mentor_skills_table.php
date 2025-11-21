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

        Schema::create('mentor_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mentor_profile_id');
            $table->unsignedBigInteger('skill_id');
            $table->timestamps();

            $table->foreign('mentor_profile_id')->references('id')->on('mentor_profiles')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');

            $table->unique(['mentor_profile_id', 'skill_id']);
            $table->index('skill_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_skills');
    }
};
