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
        Schema::create('sous_taches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tache');
            $table->string('nom');
            $table->text('description')->nullable();
            $table->date('delai');
            $table->binary('file');
            $table->timestamps();

            $table->foreign('id_tache')->references('id')->on('taches')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_taches');
    }
};
