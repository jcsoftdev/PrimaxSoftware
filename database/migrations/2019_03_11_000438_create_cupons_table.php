<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial', 60)->unique();
            $table->boolean('condicion')->default(1);
            $table->dateTime('expiracion');
            $table->tinyInteger('actualizaciones')->default(0);
            // $table->timestamps();
        }); 
        DB::table('cupons')->insert(array('serial'=>'juancarlos','condicion'=> 1,'expiracion'=>now(),'actualizaciones'=>0));
        DB::table('cupons')->insert(array('serial'=>'juancarlos1','condicion'=> 1,'expiracion'=>now(),'actualizaciones'=>0));
        DB::table('cupons')->insert(array('serial'=>'juancarlos2','condicion'=> 1,'expiracion'=>now(),'actualizaciones'=>0));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupons');
    }
}
