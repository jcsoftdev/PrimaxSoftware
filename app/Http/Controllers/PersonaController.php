<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Peru\Jne\Dni;
use Peru\Http\ContextClient;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas= Persona::all();
        return $personas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellidos = $request->apellidos;
        $persona->dni = $request->dni;
        $persona->email = $request->email;
        $persona->telefono=$request->telefono;
        $persona->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $persona = Persona::find($id);
        return $persona;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function buscarPersona(Request $request){
        // require 'vendor/autoload.php';
        $dni = $request->dni;
        $cs = new Dni();
        $cs->setClient(new ContextClient());

        $person = $cs->get($dni);
        if ($person === false) {
            echo $cs->getError();
            exit();
        }

        return json_encode($person);
    }
    public function buscarDNI(){
        $persona = DB::table('personas')->select('dni')->get();
        return $persona;
    }
    public function buscarPersonaPorDNI($dni){
        $persona = Persona::where("personas.dni",'=',"$dni")->get();
        return $persona;
    }
}
