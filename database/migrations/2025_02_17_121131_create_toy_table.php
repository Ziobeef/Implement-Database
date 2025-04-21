<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToyTable extends Migration
{
    public function up()
    {
        Schema::create('toys', function (Blueprint $table) {

            $table->id();
            $table->string('name', 64);
            $table->enum('gender', ['boy', 'girl']);
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('toys');
    }
}
