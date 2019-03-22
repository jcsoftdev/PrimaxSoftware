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
            $table->string('nombre',191);
            $table->string('apellidos',191);
            $table->string('dni',8)->unique();
            $table->string('email',100)->nullable();
            $table->string('telefono',12)->nullable();
            $table->timestamps();
        });
         DB::table('personas')->insert(array(
            'id'=>'1',
            'nombre'=>'Juan Carlos',
            'apellidos'=>'Valencia Lopez',
            'dni'=>'71887663',
            'email'=>'jc@web.com',
            'telefono'=>'931760744',
            'created_at'=>now(),
            'updated_at'=>now(),
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
