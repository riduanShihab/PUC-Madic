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
    Schema::create('doctors', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('age');
        $table->string('phone');
        $table->string('address');
        $table->date('date_of_joining');
        $table->date('date_of_birth');
        $table->string('email');
        $table->string('blood_group');
        $table->string('department');
        $table->json('specialists');
        $table->json('designations');
        $table->integer('experience');
        $table->string('profile_image')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
