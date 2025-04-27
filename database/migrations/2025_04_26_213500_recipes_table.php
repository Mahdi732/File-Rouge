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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->json('etap'); 
            $table->string('description');
            $table->string('note');
            $table->string('video');
            $table->string('image');
            $table->json('ingredients'); 
            $table->integer('timepreparation');
            $table->enum('levelPreparation', ['easy', 'medium', 'hard']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
