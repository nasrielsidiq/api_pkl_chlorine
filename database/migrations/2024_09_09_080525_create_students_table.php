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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn',12);
            $table->string('full_name');
            // $table->string('nisn', 12);
            $table->date('birth_day',);
            $table->text('adress');
            $table->string('npsn',10);
            $table->timestamps();
            $table->foreign('nisn')->references('nisn')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('npsn')->references('npsn')->on('schools')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
