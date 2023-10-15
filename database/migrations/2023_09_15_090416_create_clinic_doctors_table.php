<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('clinic_doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('doctor_id');
            $table->foreignUuid('clinic_id');
            $table->time('operation_start');
            $table->time('operation_end');
            $table->timestamps();

            // Foreign
            $table->foreign('doctor_id')->references('id')->on('doctors')->onChange('cascade')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onChange('cascade')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('clinic_doctors');
    }
};
