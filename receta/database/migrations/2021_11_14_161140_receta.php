<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Receta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("receta",function(Blueprint $table){
          
            $table->engine = 'InnoDB';
            
            $table->bigIncrements("id")->unsigned();
            $table->string("receta",200);
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
