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
        Schema::create('cratecars', function (Blueprint $table) {
            $table->id();
            $table->string('make');            
            $table->string('model');           
            $table->string('year')->nullable(); 
            $table->string('color')->nullable();
            $table->string('car_no')->nullable();
            $table->integer('km')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('usermodels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cratecars');
    }
};
