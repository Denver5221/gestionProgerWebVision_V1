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
        Schema::table('depenses', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depenses', function (Blueprint $table) {
            $table->dropForeign('depenses_id_projet_foreign'); // Supprimer la contrainte de clé étrangère si elle existe
            $table->dropColumn('id_projet'); // Supprimer la colonne "id_projet"
        });
    }
};
