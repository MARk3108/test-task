<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_brand_models', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('car_brand_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index(['car_brand_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_brand_models');
    }
};
