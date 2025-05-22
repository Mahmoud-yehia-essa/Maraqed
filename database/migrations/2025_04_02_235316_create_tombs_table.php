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
        Schema::create('tombs', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
            $table->string('BirtDate')->nullable();
            $table->string('DeathDate')->nullable();
            $table->string('BlockNumber')->nullable();
            $table->string('Vertical')->nullable();
            $table->string('Horizontal')->nullable();
            $table->string('TombNumber')->nullable();
            $table->text('DeathPhoto')->nullable();
            $table->string('TombPlace')->nullable();
            $table->string('InsideKuwait')->nullable();
            $table->text('Photo2')->nullable();
            $table->text('qrCodeTomb')->nullable();


            $table->enum('status',['active','inactive'])->default('active');

            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tombs');
    }
};
