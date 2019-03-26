<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\VentaCupon;
use App\Models\Cupon;
use App\Models\Persona;
use Carbon\Carbon;
class VentaController extends Controller
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
            $date = Carbon::now('America/Lima');
            $date = $date->toDateString();
            $venta->idpersona    = $request->idpersona;
            $venta->idmarca      = $request->idmarca;
            $venta->idusuario = \Auth::user()->id;
            // $venta->idusuario    = $request->idusuario;
            // $venta->fecha   = $date;
            $venta->localizacion = $request->localizacion;
            $venta->cantidad     = $request->cantidad;
            $venta->total        = $request->total;
            $venta->save();

            $ventaCupons = $request->arrayCupon;//Array de detalles
                //Recorro todos los elementos
                foreach($ventaCupons as $cup)
                {
                    $ventaCupon = new VentaCupon();
                    $ventaCupon->idcupon = $cup;       
                    $ventaCupon->idventa = $venta->id;
                    $ventaCupon->save();

                    $cupon = Cupon::findOrFail($cup);
                    $cupon->condicion = '0';
                    $cupon->save();
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
// SELECT 

// (SUM(ventas.total )) as 'precio', 
// (SELECT count(venta_cupons.idventa) FROM venta_cupons where venta_cupons.idventa = ventas.id ) as descuento,
// (SUM(ventas.cantidad)) as cant ,
// users.usuario , 
// personas.nombre, 
// personas.apellidos
// from ventas 
// inner join users on users.id = ventas.idusuario
// INNER JOIN personas on users.id = personas.id
// INNER JOIN marcas on marcas.id = ventas.idmarca



    // SELECT 
    // users.usuario , 
    // personas.nombre, 
    // personas.apellidos, 
    // (SUM(marcas.precio * ventas.cantidad )) as 'precio', 
    // (SELECT count(venta_cupons.idventa) FROM venta_cupons where venta_cupons.idventa = ventas.id ) as descuento,
    // (SUM(ventas.cantidad)) as cant 
    // from ventas 
    // inner join users on users.id = ventas.idusuario
    // INNER JOIN personas on users.id = personas.id
    // INNER JOIN marcas on marcas.id = ventas.idmarca









// SELECT 
// users.usuario,
// personas.nombre, 
// personas.apellidos, 
// ordenado.id
// idusuario, 
// marcas.nombre,
// SUM(cantidad) as 'CantidadVendida',
// SUM(total) as 'Total de Ingreso' 
// FROM ( SELECT * from ventas ORDER BY ventas.total DESC) as ordenado 

// inner join personas on personas.id = ordenado.idusuario
// inner join users on users.id = ordenado.idusuario
// INNER join marcas on marcas.id = ordenado.idmarca
// GROUP by idusuario, idmarca order by idusuario



// SELECT 
// idusuario,
// ordenado.created_at,
// users.usuario,
// personas.nombre, 
// personas.apellidos, 
// marcas.nombre as marca,
// SUM(cantidad) as 'CantVenta',
// SUM(total) as 'IngresoT' ,
// DATE(ordenado.created_at) as fecha
// FROM ( SELECT * from ventas ORDER BY ventas.total DESC) as ordenado 
// inner join personas on personas.id = ordenado.idusuario
// inner join users on users.id = ordenado.idusuario
// INNER join marcas on marcas.id = ordenado.idmarca
// where DATE(ordenado.created_at) = '2019-03-25'
// GROUP by users.usuario,
// personas.nombre, 
// personas.apellidos, 
// marcas.id,
// marcas.nombre 
// order by idusuario

    public function obtenerDetallerVendedor(Request $request){
        $fecha = $request->fecha;
        
        if ($fecha=='') {
            $detalle = DB::select("SELECT 
                                idusuario,
                                users.usuario,
                                personas.nombre, 
                                personas.apellidos, 
                                marcas.nombre as marca,
                                SUM(cantidad) as 'CantVenta',
                                SUM(total) as 'IngresoT' ,
                                DATE(ordenado.created_at) as fecha
                                FROM ( SELECT * from ventas ORDER BY ventas.total DESC) as ordenado 
                                inner join personas on personas.id = ordenado.idusuario
                                inner join users on users.id = ordenado.idusuario
                                INNER join marcas on marcas.id = ordenado.idmarca
                                GROUP by users.usuario,
                                personas.nombre, 
                                personas.apellidos, 
                                marcas.id,
                                marcas.nombre 
                                order by idusuario");
            return $detalle;
        } else {
            $date = Carbon::createFromIsoFormat('DD MMM YYYY', $fecha);

            $fechasel = $date->isoFormat('YYYY-MM-D');
            // echo $fechasel;
            $detalle = DB::select("SELECT 
                                idusuario,
                                users.usuario,
                                personas.nombre, 
                                personas.apellidos, 
                                marcas.nombre as marca,
                                SUM(cantidad) as 'CantVenta',
                                SUM(total) as 'IngresoT' ,
                                DATE(ordenado.created_at) as fecha
                                FROM ( SELECT * from ventas ORDER BY ventas.total DESC) as ordenado 
                                inner join personas on personas.id = ordenado.idusuario
                                inner join users on users.id = ordenado.idusuario
                                INNER join marcas on marcas.id = ordenado.idmarca
                                where  DATE(ordenado.created_at) = '$fechasel'
                                GROUP by users.usuario,
                                personas.nombre, 
                                personas.apellidos, 
                                marcas.id,
                                marcas.nombre 
                                order by idusuario");
            return $detalle;
        }
        
    }

    public function listarDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->usuario;
        $fecha = $request->fecha;
        
        if ($fecha=='') {
            if ($buscar==''){
            $detalles = Venta::join('marcas','marcas.id','=','ventas.idmarca')
            ->join('personas','personas.id','=','ventas.idpersona')
            ->join('users','users.id','=','ventas.idusuario')
            ->select(
                'users.usuario',
                
                DB::raw('concat(personas.nombre , " ", personas.apellidos) as nombre'),
                'personas.dni',
                "marcas.nombre as marca", 
                'ventas.cantidad', 
                DB::raw("(marcas.precio * ventas.cantidad ) AS precio"),
                DB::raw("(SELECT count(venta_cupons.idventa) FROM venta_cupons where venta_cupons.idventa = ventas.id ) as descuento"),
                "ventas.total",
                DB::raw('DATE(ventas.created_at) as fecha')
                )
            ->whereDate('ventas.created_at', Carbon::today()->toDateString())
            // ->where('Vendedor','=',$criterio)    
            ->orderBy('ventas.id', 'desc')->paginate(10);
            }else{
                $detalles = Venta::join('marcas','marcas.id','=','ventas.idmarca')
                ->join('personas','personas.id','=','ventas.idpersona')
                ->join('users','users.id','=','ventas.idusuario')
                ->select(
                    'users.usuario',
                    
                    DB::raw('concat(personas.nombre , " ", personas.apellidos) as nombre'),
                    'personas.dni',
                    "marcas.nombre as marca", 
                    'ventas.cantidad', 
                    DB::raw("(marcas.precio * ventas.cantidad ) AS precio"),
                    DB::raw("(SELECT count(venta_cupons.idventa) FROM venta_cupons where venta_cupons.idventa = ventas.id ) as descuento"),
                    "ventas.total",
                    DB::raw('DATE(ventas.created_at) as fecha')
                    )
                ->where('usuario','=',"$buscar")
                ->whereDate('ventas.created_at', Carbon::today()->toDateString())
                ->orderBy('ventas.id', 'desc')->paginate(10);
            }
        } else {
            $date = Carbon::createFromIsoFormat('DD MMM YYYY', $fecha);

            $date = $date->isoFormat('YYYY-MM-D');
            if ($buscar==''){
                $detalles = Venta::join('marcas','marcas.id','=','ventas.idmarca')
                ->join('personas','personas.id','=','ventas.idpersona')
                ->join('users','users.id','=','ventas.idusuario')
                ->select(
                    'users.usuario',
                    
                    DB::raw('concat(personas.nombre , " ", personas.apellidos) as nombre'),
                    'personas.dni',
                    "marcas.nombre as marca", 
                    'ventas.cantidad', 
                    DB::raw("(marcas.precio * ventas.cantidad ) AS precio"),
                    DB::raw("(SELECT count(venta_cupons.idventa) FROM venta_cupons where venta_cupons.idventa = ventas.id ) as descuento"),
                    "ventas.total",
                    DB::raw('DATE(ventas.created_at) as fecha')
                    )
                ->whereDate('ventas.created_at', $date)
                // ->where('Vendedor','=',$criterio)    
                ->orderBy('ventas.id', 'desc')->paginate(10);
            }else{
                $detalles = Venta::join('marcas','marcas.id','=','ventas.idmarca')
                ->join('personas','personas.id','=','ventas.idpersona')
                ->join('users','users.id','=','ventas.idusuario')
                ->select(
                    'users.usuario',
                    
                    DB::raw('concat(personas.nombre , " ", personas.apellidos) as nombre'),
                    'personas.dni',
                    "marcas.nombre as marca", 
                    'ventas.cantidad', 
                    DB::raw("(marcas.precio * ventas.cantidad ) AS precio"),
                    DB::raw("(SELECT count(venta_cupons.idventa) FROM venta_cupons where venta_cupons.idventa = ventas.id ) as descuento"),
                    "ventas.total",
                    DB::raw('DATE(ventas.created_at) as fecha')
                    )
                ->where('usuario','=',"$buscar")
                ->whereDate('ventas.created_at', $date)
                ->orderBy('ventas.id', 'desc')->paginate(10);
            }
        }
        
        
        return [
            'pagination' => [
                'total'        => $detalles->total(),
                'current_page' => $detalles->currentPage(),
                'per_page'     => $detalles->perPage(),
                'last_page'    => $detalles->lastPage(),
                'from'         => $detalles->firstItem(),
                'to'           => $detalles->lastItem(),
            ],
            'detalles' => $detalles
        ];
        
    }
}
