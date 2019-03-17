<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaCupon;
use App\Models\Venta;
class VentaCuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            DB::beginTransaction();
            $venta = new Venta();
            $venta->idpersona    = $request->idpersona;
            $venta->idmarca      = $request->idmarca;
            // $venta->idusuario = \Auth::user()->id;
            $venta->idusuario    = $request->idusuario;
            $venta->hora_fecha   = Carbon::now('America/Lima');
            $venta->localizacion = $request->localizacion;
            $venta->cantidad     = $request->cantidad;
            $venta->total        = $request->total;
            // echo $venta;
            $venta->save();

            $ventaCupon = $request->arrayCupon;//Array de detalles
                //Recorro todos los elementos
                foreach($ventaCupon as $cp=>$cup)
                {
                    $ventaCupon = new VentaCupon    ();
                    $ventaCupon->idcupon = $cup['idcupon'];       
                    $ventaCupon->idventa = $venta->id;
                    $ventaCupon->save();
                }
            DB::commit();
        } catch (Exception $e) {
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
}
