<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToyHelpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toy_helpers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toy_id')->constrained('toys')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('toy_categories')->onDelete('cascade');
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
        Schema::dropIfExists('toy_helpers');
    }
}
