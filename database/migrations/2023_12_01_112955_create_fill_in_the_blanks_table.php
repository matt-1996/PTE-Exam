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
        Schema::create('fill_in_the_blanks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('context');
            $table->string('code', 100);
            $table->integer('duration');
            $table->string('answer');
            $table->text('explanation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_in_the_blanks');
    }
};
