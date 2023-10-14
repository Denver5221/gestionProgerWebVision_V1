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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('NumeroFacture')->nullable();
            $table->string('Objet');
            $table->date('date_echeant')->nullable();
            $table->date('date_facture')->nullable();
            $table->string('type');
            $table->string('tax_nom')->nullable();
            $table->float('tax_percent')->nullable();
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_category')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('id_client')->references('id')->on('info_clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
};
