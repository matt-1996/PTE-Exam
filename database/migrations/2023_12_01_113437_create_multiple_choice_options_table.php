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
        Schema::create('multiple_choice_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multiple_choice_id');
            $table->string('option');
            $table->string('code', 100);
            $table->integer('duration');
            $table->boolean('is_right_option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiple_choice_options');
    }
};
