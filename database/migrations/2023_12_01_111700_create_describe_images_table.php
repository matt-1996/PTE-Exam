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
        Schema::create('describe_images', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('image_path');
            $table->integer('duration');
            $table->string('code' , 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('describe_images');
    }
};
