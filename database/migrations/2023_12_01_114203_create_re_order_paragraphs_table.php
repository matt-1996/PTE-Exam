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
        Schema::create('re_order_paragraphs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('paragraph_id');
            $table->foreign('paragraph_id')->references('id')->on('paragraphs')->onDelete('cascade');
            $table->string('code', 100);
            $table->integer('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('re_order_paragraphs');
    }
};
