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
        Schema::create('practices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('duration');
            $table->string('code' , 100);
            $table->enum('type',['read_aoud','repeat_sentence','describe_image',
                're_tell_lecture', 'asq', 'swt', 'write_essay', 'RW_FIB','reading_multiple_choice',
                're_order_paragraph', 'R_FIB', 'MCS','SPT','LMC', 'L_FIB','HCS','L_MCS','SMW','HIW','WFD']);
            $table->text('context')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practices');
    }
};
