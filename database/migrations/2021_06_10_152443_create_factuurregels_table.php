<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactuurregelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factuurregels', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('omschrijving');
            $table->string('aantal');
            $table->string('ppe');
            $table->string('bedrag');
            $table->string('btw');
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
        Schema::dropIfExists('factuurregels');
    }
}
