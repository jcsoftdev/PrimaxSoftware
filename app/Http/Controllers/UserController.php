<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Persona;
class UserController extends Controller
{
    public function index(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('rols','users.idrol','=','rols.id')
            ->select('personas.id','personas.nombre','personas.apellidos',
            'personas.dni','personas.telefono',
            'personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','rols.nombre as rol')  
            ->orderBy('personas.id', 'desc')->paginate(5);
        }
        else{
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('rols','users.idrol','=','rols.id')
            ->select('personas.id','personas.nombre','personas.apellidos',
            'personas.dni','personas.telefono',
            'personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','rols.nombre as rol')            
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(5);
        }
        

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();
                $persona = new Persona();
                $persona->nombre = $request->nombre;
                $persona->apellidos = $request->apellidos;
                $persona->dni = $request->dni;
                $persona->email = $request->email;
                $persona->telefono = $request->telefono;
                $persona->save();

                $user = new User();
                $user->id = $persona->id;
                $user->usuario = $request->usuario;
                $user->password = bcrypt( $request->password);
                $user->condicion = '1';
                $user->idrol = $request->idrol;          

            

            $user->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Buscar primero el proveedor a modificar
            $user = User::findOrFail($request->id);

            $persona = Persona::findOrFail($user->id);

            $persona->nombre = $request->nombre;
            $persona->apellidos = $request->apellidos;
            $persona->dni = $request->dni;
            $persona->email = $request->email;
            $persona->telefono = $request->telefono;
            $persona->save();

            
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();


            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
    public function showVendedor(){

        $vendedor = User::select('users.usuario','users.id')
        ->where('users.idrol','=','1')
        ->orWhere('users.idrol','=','2')
        ->orderBy('users.id','asc')
        ->get();
        return $vendedor;
    }
}
