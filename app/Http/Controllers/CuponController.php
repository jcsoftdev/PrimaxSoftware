<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cupon;
use Carbon\Carbon;
use DB;
class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $condicion = $request->condicion;
        $cupones = Cupon::select(
            
            'cupons.id',
            'cupons.serial',
            'cupons.condicion',
            'cupons.expiracion'
            )->where('cupons.condicion','=',$condicion)->get();
        return $cupones;
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
    {   try{
            DB::beginTransaction();
        $cantidad = $request->cantidad;
        $meses = $request->meses;
        $this->InsertCantCupon($cantidad,$meses);
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function crearCodigo(){
        
        $aleatoria = array("");
        $caracteres = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        for($x = 0; $x < 3; $x++){
            $aleatoria[] = substr(str_shuffle($caracteres), 0, 20);
            $codigo[] = $aleatoria;
            // echo $aleatoria . "\n";
        }
        $codigo =  implode ( "", $aleatoria ) ;
        // echo $codigo;
        return $codigo;
    }
    public function cuponInsertar($month){
        $a = 0;
        $buscar[] = '';
        $buscar[] = Cupon::select('cupons.serial')->get();
        while ($a < 1) {
            $codigo = $this->crearCodigo();
            $buscar[] = $codigo;
            if(count($buscar) > count(array_unique($buscar))){
                echo "¡Hay repetidos!";
                
            }else{
                $Cupon = new Cupon();
                // $codigo = $this->crearCodigo();
                $Cupon->serial = $codigo;
                $Cupon->expiracion = Carbon::now('America/Lima')->addMonths($month);
                $Cupon->save();
                $a ++;
            }
        } 
    }
    public function InsertCantCupon($cant, $month){
        try {
            DB::beginTransaction();
            for ($i=0; $i < $cant; $i++) { 
                $this->cuponInsertar($month);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function buscarCuponSerial($cupon){
        $cupon = Cupon::where("cupons.serial",'=',"$cupon")->where("cupons.condicion",'=','1')->get();
        return $cupon;
    }
    public function getCantidad(Request $request){
        $condicion = $request->condicion;
        $cupones = Cupon::select(
            'cupons.id',
            'cupons.serial',
            'cupons.condicion',
            'cupons.expiracion'
            )->where('cupons.condicion','=',$condicion)->count();
        return $cupones;
    }
    // public function desactivar(Request $request)
    // {
    //     // if (!$request->ajax()) return redirect('/');
    //     $cupon = Cupon::findOrFail($request->id);
    //     $cupon->condicion = '0';
    //     $cupon->save();
    // }
    // public function activar(Request $request)
    // {
    //     // if (!$request->ajax()) return redirect('/');
    //     $cupon = Cupon::findOrFail($request->id);
    //     $cupon->condicion = '1';
    //     $cupon->save();
    // }

    public function actualizar(Request $request){
        //  if (!$request->ajax()) return redirect('/');
        $meses = $request->meses;
        try{
            DB::beginTransaction();

            //Actualizar la table cupones
            DB::table('cupons')
            ->where('condicion', 2)
            ->update([
                'condicion' => 1,
                'actualizaciones' => DB::raw('actualizaciones + 1'),
                'expiracion'=> Carbon::now()->addMonths($meses)
                

                ]);

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
    public function activar(){
        //  if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Actualizar la table cupones
            DB::table('cupons')
            ->where('condicion', 0)
            ->update(['condicion' => 1]);
            
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
    public function desactivaInf(){
        try{
            DB::beginTransaction();
            //En este caso no eliminamos la tabla, sino que desactivamos al cupon de manera indefinida y le agregamos el valor de 3 en condicion
            //Actualizar la table cupones
            DB::table('cupons')
            ->where('actualizaciones', '>', 4)
            ->update(['condicion' => 3]);
            
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function vencimiento(){
        try{
            DB::beginTransaction();
            DB::table('cupons')
            ->where('expiracion','<', Carbon::now('America/Lima'))
            ->update(['condicion' => 2]);
            
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
