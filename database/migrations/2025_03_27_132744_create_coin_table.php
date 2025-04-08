<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurs_id')->constrained('kurs')->onDelete('cascade');
            $table->string('name', 32);
            $table->string('code', 8);      
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
        Schema::dropIfExists('coin');
    }
}
