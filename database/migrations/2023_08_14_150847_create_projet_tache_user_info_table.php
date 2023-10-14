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
        Schema::create('projet_tache_user', function (Blueprint $table) {
            $table->unsignedBigInteger('id_projet');
            $table->unsignedBigInteger('id_tache');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_priorite');

            $table->foreign('id_projet')->references('id')->on('projets')->onDelete('cascade');
            $table->foreign('id_tache')->references('id')->on('taches')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_priorite')->references('id')->on('priorites')->onDelete('cascade');


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
        Schema::dropIfExists('projet_tache_user');
    }
};
