<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pedidos",function(Blueprint $table){
          
            $table->engine = 'InnoDB';
            
            $table->bigIncrements("id")->unsigned();
            $table->integer("idreceta");
            $table->integer("estado");
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
