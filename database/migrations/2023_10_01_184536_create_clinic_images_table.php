<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('clinic_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->foreignUuid('clinic_id');
            $table->timestamps();

            // Foreign
            $table->foreign('clinic_id')->references('id')->on('clinics')->onChange('cascade')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('clinic_images');
    }
};
