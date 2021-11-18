<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ingredientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ingredientes",function(Blueprint $table){
          
            $table->engine = 'InnoDB';
            
            $table->bigIncrements("id")->unsigned();
            $table->string("ingrediente",200);
            $table->integer("cantidad_disponible");
            $table->timestamps();// crea campos de fecha de insert y update
            $table->softDeletes();// para crear un campo de eliminacion logica no fisica
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
