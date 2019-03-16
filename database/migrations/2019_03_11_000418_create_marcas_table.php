<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100);
            $table->double('precio',3);
            // $table->timestamps();
        });
        DB::table('marcas')->insert(array('nombre'=>'Primax Gas','precio'=> 34.5));
        DB::table('marcas')->insert(array('nombre'=>'Pecsa Gas','precio'=> 27.5));
        DB::table('marcas')->insert(array('nombre'=>'Pro Gas','precio'=> 24.5));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
