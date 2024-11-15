<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_image', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('property_id'); // Unsigned to match parent
            $table->string('path');
            $table->string('caption')->nullable();
        
            // Foreign key definition
            // $table->foreign('property_id')->references('property_id')->on('property');
        
            $table->timestamps();
        });
        

  
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_image');
    }
}
