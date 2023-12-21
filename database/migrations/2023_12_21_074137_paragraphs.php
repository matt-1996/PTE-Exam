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
        Schema::create('paragraphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practice_id');
            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
            $table->text('paragraph');
            $table->integer('order');
            $table->integer('answer_order');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paragraphs');

    }
};
