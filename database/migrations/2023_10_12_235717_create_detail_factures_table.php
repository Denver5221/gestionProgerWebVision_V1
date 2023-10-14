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
        Schema::create('detail_factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_facture');
            $table->string('designation');
            $table->string('details');
            $table->string('prix_unitaire');
            $table->string('quantite');
            $table->string('total');
            $table->timestamps();

            $table->foreign('id_facture')->references('id')->on('factures')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_factures');
    }
};
