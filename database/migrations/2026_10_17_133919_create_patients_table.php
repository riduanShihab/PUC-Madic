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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->unique();
            $table->string('name');
            $table->string('gender', 20);
            $table->integer('age');
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact', 20)->nullable();
            $table->text('medical_history')->nullable();
            $table->string('allergies')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
