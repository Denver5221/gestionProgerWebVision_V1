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
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_permission');
   
            //FOREIGN KEY
            $table->foreign('id_role')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('id_permission')->references('id')->on('permissions')->onDelete('cascade');
   
            //PRIMARY KEYS
            $table->primary(['id_role','id_permission']);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permissions');
    }
};
