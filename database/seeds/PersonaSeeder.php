<?php

use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    private function getFullname()
	{
		
		$nombres = ['MARIA','JOSE','JUAN','LUIS','CARLOS','ROSA','JORGE','VICTOR','ANA','LUZ','CESAR','CARMEN','MIGUEL','JULIO','JESUS','PEDRO','MANUEL','JUANA','SANTOS','SEGUNDO','JHON','DAVID','ANGEL','JULIA','DIEGO','FLOR','ELIZABETH','DANIEL','OSCAR','RUTH','DIANA','MARCO','EDWIN','JAVIER','WALTER','FRANCISCO','FERNANDO','MILAGROS','ALEJANDRO','RAUL','RICARDO','ALEX','ROBERTO','EDGAR','VICTORIA','EDUARDO','MARIO','JAIME','GLORIA','ANDREA'];
		$n = rand(1,3);
		$name = "";
		switch($n){
			case 1:{
				$name = $nombres[rand(0,49)];
			};break;
			case 2:{
				$name = $nombres[rand(0,49)]." ".$nombres[rand(0,49)];
			};break;
			case 3:{
				$name = $nombres[rand(0,49)]." ".$nombres[rand(0,49)]." ".$nombres[rand(0,49)];
			};break;
		}
		$fullname =$name;
		return $fullname;
    }
    function getApellido(){
        $apellidos = ['QUISPE','FLORES','RODRIGUEZ','SANCHEZ','GARCIA','ROJAS','DIAZ','TORRES','LOPEZ','GONZALES','PEREZ','CHAVEZ','VASQUEZ','RAMOS','RAMIREZ','MENDOZA','ESPINOZA','CASTILLO','HUAMAN','VARGAS','MAMANI','FERNANDEZ','GUTIERREZ','RUIZ','CASTRO','ROMERO','SALAZAR','CRUZ','GOMEZ','RIVERA','MEDINA','LEON','PAREDES','SILVA','MARTINEZ','REYES','MORALES','CORDOVA','HERRERA','DELGADO','PALOMINO','AGUILAR','CARDENAS','DE LA CRUZ','RIOS','ALVARES','VEGA','CAMPOS','CALDERON','ALVARADO'];
        return  $apellidos[rand(0,49)];
    }
    function getDNI($dni){
        $dni = 20000000 + $dni;
        return $dni;
    }
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        for($i=1;$i<=100000;$i++){
            DB::table('personas')->insert([
                'nombre'=>$this->getFullname(),
                'apellidos'=>$this->getApellido(),
                'dni'=>$this->getDNI($i),
                'email'=>'persona'.$i.'@gmail.com',
                'telefono'=>'931760744',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
		
	}
}
