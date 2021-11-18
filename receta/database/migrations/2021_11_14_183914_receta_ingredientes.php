<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecetaIngredientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("receta_ingredientes",function(Blueprint $table){
          
            $table->engine = 'InnoDB';
            
            $table->integer("idreceta");
            $table->integer("idingrediente");
            $table->integer("cantidad_ingrediente");
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
