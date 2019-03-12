<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',64);
            $table->string('apellidos',64);
            $table->string('dni',8);
            $table->string('email',100)->default(null);
            $table->string('telefono',9)->default(null);
            $table->timestamps();
        });
         DB::table('personas')->insert(array('id'=>'1','nombre'=>'Juan Carlos',
         'apellidos'=>' alencia Lopez',
         'dni'=>'71887663',
         'email'=>'jc@web.com',
         'telefono'=>'931760744'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
