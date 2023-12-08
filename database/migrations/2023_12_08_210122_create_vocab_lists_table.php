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
        Schema::create('vocabs', function (Blueprint $table) {
            $table->id();
            $table->string('vocab');
            $table->string('translation');
            $table->unsignedBigInteger('dictionary_id');
            $table->foreign('dictionary_id')->references('id')->on('dictionaries')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocab_lists');
    }
};
