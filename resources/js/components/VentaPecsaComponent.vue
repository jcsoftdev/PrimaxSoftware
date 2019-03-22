<template>
    <div class="contenido-general ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 >
            <span v-text="marca"></span>
            <small v-text="'Realice una venta de '+ marca"></small>
            <span v-text="'S/ '+precioMarca"></span>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ventas</li>
          </ol>
        </section>
         <!-- Main content -->
         <div class="mi-contenido container-fluid">
             <section class="content">
                <form action="">
                    <div class="datos d-flex" >
                        <div class="dni">
                            <label class="" for="dni">DNI</label>
                            <!-- <input type="text" name="DNI" id="dni" pattern="[0-9]{9}" placeholder="Ingrese el Nro de DNI"> -->
                            <input v-model="nroDNI"  :maxlength="8" v-on:keyup="buscarDNI(); getPersonaId(nroDNI)" id="dni" class="onlyNum"  placeholder="Ingrese DNI" >
                            
                        </div>
                        
                        <div class="dni-resultado">

                                <p class="col-xs-4">

                                </p >
                                <p class="col-xs-8" v-if="nroDNI.length < 8 || nombre == null || nombre == undefined">
                                    <span v-text="condicionDNI" class="text-danger text-center"></span>
                                </p>
                                <p class="col-xs-8" v-if="nroDNI.length == 8 &&  nombre != null && nombre != undefined">
                                    <span v-text="condicionDNI" class="text-info"></span>
                                    <span v-text="nombre"></span>
                                    <span v-text="aPaterno"></span>
                                    <span v-text="aMaterno"></span>
                                    
                                </p>
                                
                        </div>

                        <div class="cantidad onlyNum">
                            <label class="" for="cantidad" >Cantidad de balones</label>
                            <input v-model="cantidad" id="cantidad" v-on:keyup="calcularTotal()" type="text" class="onlyNum" placeholder="Cantidad de balones" value="">
                            
                        </div>
                        <div class="cupon">
                            <label class="" for="cupon">Utiliza cupon?</label>
                            <input type="button" @click="abrirModal()" class="btn btn-success " value="Escanear el codigo QR" data-toggle="modal" data-target="#myModal" id="cupon">
                        </div>
                        <!-- <div class="telefono">
                            <label class="" for="numero">Numero Celular</label>
                            <input id="telefono" v-model="telefono" onKeyUp="" type="number" class="onlyNum" pattern="[0-9] {9}" >
                        </div> -->
                    </div>
                    
                    

                    <div  class="datos d-flex flex-r" >
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="precio">
                                <label class="col-xs-6" for="precio">Precio</label>
                                <input v-model="precio" class="col-xs-6"  type="text" name="precio" id="precio">
                            </div>
                            
                            <div class="descuento">
                                <label class="col-xs-6" for="descuento">Descuento </label>
                                <input v-model="descuento" class="col-xs-6" type="text" name="descuento" id="descuento">
                            </div>

                            <div class="total">
                                <label class="col-xs-6" for="total">Total a pagar</label>
                                <input v-model="precioTotal" class="col-xs-6" type="text" name="total" id="total">
                            </div>
                            <div></div>
                            <div class="vender">
                                <input  @click="realizarRegistroVenta()" type="button" class="btn btn-info" value="Validar venta" id="vender">
                            </div>
                            
                        </div>
                    </div>
                </form>
                    
                
                <!-- tabla de informacion de cupones -->
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lista de cupones a usar</font></font></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Numero cupon</font></font></th>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigo cupon</font></font></th>
                                <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Habilitado</font></font></th>
                                <th style="width: 40px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Quitar</font></font></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <tr v-for="(cupon, i) in codigoQR" :key="cupon.id">
                            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;" v-text="i+1">.</font></font></td>
                            <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;" v-text="cupon"></font></font></td>
                            <td>Habilitado
                            </td>
                            <td><a href="#"><span class="badge bg-red"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fa fa-trash"></i></font></font></span></a></td>
                        </tr>
                        
                    </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    
                </div>
                
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" @click="stopScanner();calcularTotal()" class="right btn btn-danger btn-sm " data-toggle="modal" data-target="#myModal">Cerrar &times;</button>
                                
                                <!-- <button @click="stopScanner" type="button" class="close" data-dismiss="modal">&times;</button> -->
                                <h4 class="modal-title">Escanee el codigo QR</h4>
                            </div>
                            <div class="modal-body d-flex center">
                                
                                <video id="modalCamera" class="center ">
                                    
                                </video>
                                
                            </div>
                            
                        </div>

                    </div>
                </div>
                
            </section>
        </div>
        
        <!-- Main content END -->
    </div>
</template>

<script>
    import Toasted from 'vue-toasted';
import { async } from 'q';

   

    // you can also pass options, check options reference below
    Vue.use(Toasted);
    // import VeeValidate from 'vee-validate';
    // Vue.use(VeeValidate);
    // you can call like this in your component
    
    export default {
        data() {
            return{
                scanner: '',
                codigoQR: [],
                idcodigoQR: [],
                nroDNI: '',
                condicionDNI:'',
                nombre: '',
                aPaterno: '',
                aMaterno:'',
                cantidad: '',
                telefono: '',
                tituloModal: '',
                marca: '',
                precioMarca:0,
                precio: 0,
                descuento:0,
                precioTotal:0,
                idmarca: '',
                idpersona: 0,
                fecha: '',
                respuestaLocalizacion: '',
            }
        },
        methods:{
            inicialConf(){
                document.getElementById("vender").disabled = true;
                document.getElementById("precio").disabled = true;
                document.getElementById("descuento").disabled = true;
                document.getElementById("total").disabled = true;
                document.getElementById("cantidad").disabled = true;
                document.getElementById("cupon").disabled = true;
            },
            onlyNum(){
                $(".onlyNum").keydown(function(event){
                    //alert(event.keyCode);
                    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode ==190  && event.keyCode ==110 && event.keyCode !==8 && event.keyCode !==9  ){
                        return false;
                    }
                });
                ;
            },
            buscarDNI(){
                
                this.condicionDNI = 'Este DNI no puede entrar al canjeo'
                if (this.nroDNI.length == 8) {
                    console.log('dni lenght == 8');
                    axios.post('/buscarDNI', {
                    'dni' : this.nroDNI
                    }).then(response => {
                    // JSON responses are automatically parsed.
                        let me = this;
                        
                        me.nombre= response.data.nombres;
                        me.aPaterno= response.data.apellidoPaterno;
                        me.aMaterno= response.data.apellidoMaterno;
                        if (me.nombre != undefined) {
                            if (me.nombre.length > 0 && me.nroDNI.length == 8) {
                                me.condicionDNI = 'DNI Validado'
                                document.getElementById("cantidad").disabled = false;
                                document.getElementById("cupon").disabled = false;
                            }else{
                                document.getElementById("cantidad").disabled = true;
                                document.getElementById("cupon").disabled = true;
                                document.getElementById("vender").disabled = true;
                            }
                        }else{
                            document.getElementById("cantidad").disabled = true;
                            document.getElementById("cupon").disabled = true;
                            document.getElementById("vender").disabled = true;
                        }
                        
                        
                        
                    })
                    .catch(e => {
                        console.log(e);
                    });
                }else{
                    this.nombre = undefined;
                    this.aPaterno = undefined;
                    this.aMaterno = undefined;
                    this.idpersona = 0;
                    this.cantidad = '';
                    console.log('length dni =! 8');
                    document.getElementById("cantidad").disabled = true;
                    document.getElementById("cupon").disabled = true;
                    document.getElementById("vender").disabled = true;
                }
            },
            scanearQR(){
                let me = this;
                me.scanner = new Instascan.Scanner({ video: document.getElementById('modalCamera') });
                me.scanner.addListener('scan', function (content) {
                    
                    if (me.codigoQR.indexOf(content) == -1) {
                        axios.get('/cupon/'+content)
                        .then(function (response) {
                            // handle success
                            console.log(response);
                            // console.log(response.length);
                            console.log('id DB: '+response.data[0].id);
                            // console.log(response.data[0].length);
                            if(response.data[0].id>0){
                                me.idcodigoQR.push(response.data[0].id);
                                me.codigoQR.push(content);
                                me.calcularTotal();
                                me.apareceAlerta('success','Codigo/Cupon validado','Codigo/Cupon agrgado correctamente');
                                console.log(content);
                            }else{
                                 me.apareceAlerta('error','Código no Validado','Intente escanear un código válido');
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            me.apareceAlerta('error','Código no Validado','Intente escanear un código válido');
                            // console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
                        
                        

                    }else{
                        me.apareceAlerta('error', 'Codigo Ya Agregado');
                    }
                    
                    
                    // me.scanner.stop();
                });
                Instascan.Camera.getCameras().then(function (cameras) {
                    if (cameras.length > 0) {
                    me.scanner.start(cameras[0]);
                    } else {
                    console.error('No cameras found.');
                    }
                }).catch(function (e) {
                    console.error(e);
                });   
                
            },
            apareceAlerta($type, $title, $mensaje){
                
                Swal.fire({
                    type:       $type,
                    title:      $title,
                    text: $mensaje,
                    showConfirmButton: false,
                    timer:      3000
                });
            },
            stopScanner(){
                let me = this;
                 me.scanner.stop();
            },
            abrirModal(){
                
                this.scanearQR();
            },
            getMarca(){
                let me = this;
                var url = '/marca';
                axios.get ( url ).then( function (response){
                    var respuesta = response.data;
                    // console.log(respuesta);
                    // console.log(respuesta[0].nombre);
                    // console.log(respuesta.nombre);
                    me.idmarca = respuesta[1].id;
                    me.marca = (respuesta[1].nombre);
                    me.precioMarca = respuesta[1].precio;
                    
                }) 
                .catch (function (error){
                    console.log(error);
                });
                
            },
            getPersonaId(dni){
                console.log('obteniendo id de persona');
                let me = this;
                var url = "/persona/"+dni;
                
                if (dni.length == 8) {
                  axios.get ( url ).then( function (response){
                        // console.log(url);
                        
                        // var respuesta = response.data;
                        // id = respuesta[0].id;
                        // console.log('id ' + id);
                        // console.log(response.data[0]);
                        
                        if (response.data[0] != undefined) {
                            me.idpersona = response.data[0].id;
                            console.log('ID persona '+me.idpersona);
                        }else{
                            console.info('error: No existe Usuario en la base de datos');
                        }
                         
                    }) 
                    .catch (function (error){
                        console.log(error);
                    });
                } else {
                    
                }
            },
            getDescuento(){
                var desc = 0;
                for (let i = 0; i < this.codigoQR.length; i++) {
                    // me.descuento ++;
                    desc ++;
                    
                }
                return desc;
            },
            calcularTotal(){
                var me = this;
                // console.log(me.getPersonaId('71887664'));
                // if (me.getPersonaId(me.nroDNI)) {
                    // if (me.nroDNI.length == 8 && me.nombre != null) {
                        if (parseFloat(this.cantidad)>0) {
                        me.precio = parseFloat(me.precioMarca) * parseFloat(me.cantidad);
                        console.log(me.codigoQR.length);
                        me.descuento = me.getDescuento();
                        
                        me.precioTotal = parseFloat(me.precioMarca) * parseFloat(me.cantidad)-this.getDescuento();
                        console.log(me.precioTotal);
                        
                        document.getElementById("vender").disabled = false;
                        }
                        else{
                            document.getElementById("vender").disabled = true;
                            me.precio = 0;
                            me.descuento = 0;
                            me.precioTotal = 0;
                        }
                    // }
                    // else{
                    //     document.getElementById("vender").disabled = true;
                    // }
                // } else {
                    
                // }
                
                
            },
            validarCliente(){
                var dni = this.nroDNI;
                var cont = 0;
                
                axios.get('/persona')
                .then(function (response) { 
                    let respuesta = response.data;
                    console.log('validando');
                    for (let i = 0; i < respuesta.length; i++) {
                       
                        if (respuesta[i].dni == dni) {
                            cont = cont + 1;
                            console.log(respuesta[i]);
                            return cont;
                        }
                        
                    }
                    // console.log(cont);
                    
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
                
                    
                
            },
            registrarCliente(){
                console.log('registrando cliente');
                axios.post('/persona/registrar', {
                'nombre' : this.nombre,
                'apellidos' : this.aPaterno + ' ' + this.aMaterno,
                'dni' : this.nroDNI,
                'email': '',
                'telefono' : this.telefono,


                })
                .then(function (response) {
                    console.log(response);
                  })
                .catch(function (error) {
                    console.log('error de registro de cliente');
                });
            },
            obtenerLocalizacion(){
                var me = this;
                (function(){
                    if (navigator.geolocation)
                    {
                        navigator.geolocation.getCurrentPosition(function(objPosition)
                        {
                            var lon = objPosition.coords.longitude;
                            var lat = objPosition.coords.latitude;

                            // me.respuestaLocalizacion = "Latitud:" + lat + " Longitud:" + lon + "";
                            me.respuestaLocalizacion = "" + lat + " " + lon + "";

                        }, function(objPositionError)
                        {
                            switch (objPositionError.code)
                            {
                                case objPositionError.PERMISSION_DENIED:
                                    me.respuestaLocalizacion = "No se ha permitido el acceso a la posición del usuario.";
                                break;
                                case objPositionError.POSITION_UNAVAILABLE:
                                    me.respuestaLocalizacion = "No se ha podido acceder a la información de su posición.";
                                break;
                                case objPositionError.TIMEOUT:
                                    me.respuestaLocalizacion = "El servicio ha tardado demasiado tiempo en responder.";
                                break;
                                default:
                                    me.respuestaLocalizacion = "Error desconocido.";
                            }
                        }, {
                            maximumAge: 75000,
                            timeout: 15000
                        });
                        console.log('object');
                    }
                    else
                    {
                        me.respuestaLocalizacion = "Su navegador no soporta la API de geolocalización.";
                    }
                })();
                
                
            },
            realizarRegistroVenta(){
                var me = this;
                if (me.idpersona==0) {
                    
                    function res(){
                        if (me.idpersona==0) {
                            function f1() {
                                Vue.nextTick(me.registrarCliente());
                            }
                            function f2() {
                                Vue.nextTick(
                                    
                                )
                                    ;
                                // return 'registrado'
                                
                            }
                            function f3() {
                                Vue.nextTick(
                                    me.registrarVenta()
                                )
                                   ;
                                
                            }
                            f1();
                            setTimeout(function () {
                                me.getPersonaId(me.nroDNI)
                            },100);
                            setTimeout(function () {
                                me.registrarVenta()
                            }, 500);
                            // setTimeout(f3(), 100000);
                            // if (f2() == 'registrado') {
                            //     f3();
                            // }
                        } else {
                            (function () {
                                me.registrarVenta();
                            })
                        }
                    }
                    res();
                } else {
                    me.registrarVenta();
                }
                
            },
            registrarVenta(){
                console.log('registrando venta');
                var me = this;
                console.log(me.idcodigoQR);
                axios.post('/venta/registrar', {
                    'idpersona': me.idpersona,
                    'idmarca': me.idmarca,
                    'idusuario': 1,
                    'localizacion': me.respuestaLocalizacion,
                    'cantidad': me.cantidad,
                    'total': me.precioTotal,
                    'arrayCupon' : me.idcodigoQR
                })
                .then(function (response) {
                if (response=!null) {
                    // for (let i = 0; i < me.codigoQR.length; i++) {
                    //     me.desactivarCupon(i+1);
                        
                    // }

                    Swal.fire({
                        type: 'success',
                        title: 'Venta Registrada',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    me.precio = 0;
                    me.descuento = 0;
                    me.precioTotal = 0;
                    me.nroDNI = '';
                    me.cantidad = '';
                    me.codigoQR = [];
                } 
                    
                })
                .catch(function (error) {
                console.log(error);
                    Swal.fire({
                        type:       'error',
                        title:      'No se pudo registrar la venta',
                        text: 'Error: '+error,
                        showConfirmButton: false,
                        timer:      3000
                    })
                });

            },
            registrarVentaCupon(){
                
            },
            desactivarCupon(id){
                console.log('entrandfo a desactivar cupon');
                axios.put('/cupon/desactivar', {
                    id : id,
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
        },
        mounted(){
            
            
            this.inicialConf();
            this.getMarca();
            this.onlyNum();
            this.buscarDNI();
            this.obtenerLocalizacion();
            // console.log(this.respuestaLocalizacion);
            // console.log(this.getPersonaId('71887664'));
            // this.validarCliente();
            // this.abrirModal();
        },
        
    }

</script>
<style>
/* apply a natural box layout model to all elements, but allowing components to change */
html {
  box-sizing: border-box;
}
*, *:before, *:after {
  box-sizing: inherit;
}
label{
     width: 32%;
     /* padding-bottom: 0; */
    /* text-align: right; */
    /* padding-right: 2rem; */
}
input, input:before , input:after{
    border: 1px solid #ccc;
    border-radius: .7rem;
    height: 40px;
    width: 65%;
    text-align: center;
}
p{
    display: inline-block;
    width: 100%;    
}
.text-center{
    /* display: inline-block;
    width: 100%;     */
    text-align: center
}
.content{
    position: relative;
    width: 100%;
    height: 100%;
}
.content>h1{
    text-align: center;
}
.content-wrapper{
    /* overflow: scroll;
    max-height: 90vh; */
}
.mi-contenido{
    height: 100%;
    width: 80%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
}
.center{
    flex-direction: column;
    flex-wrap: nowrap;
    align-items: center;
}
.col-4{
    width: 33.33333333%
}
.col-8{
    width: 66.66666666%;
}
.d-flex{
    display: flex;
}
.flex-r{
    flex-direction: row !important;
}
.bg-azul{
    background-color: rgba(2, 24, 150, 0.11);
}
.right{
    float: right;
}
.datos{
    flex-direction: column;
    justify-content: center;
    align-self: center;
}
.datos>div{
    margin-bottom: 1rem;
    display: flex;
   justify-content: center;
   align-items: center;
}
.datos>.col-sm-6{
    display: inline-block;
}
.datos>.col-sm-6>div{
    width: 100%;
    margin-bottom: .3rem;
    /* display: inline-block; */
    /*  */
    display: flex;
   justify-content: center;
   align-items: center;
}
.vender{
    margin-top: 2rem;
}
#myModal{
    padding: 0 !important;
    margin: 0 ;
    padding: 0;
    margin-left: 0;
    min-height: 100vh;
    min-width: 100vw;
    overflow: hidden;
    /* position: absolute; */
}
.modal-dialog{
    margin: 0 !important;
    box-sizing: border-box;
    width: 100%;
      height: 100%; 
}
.modal-content{
    height: 100%;
}
.modal-body{
    height: 100%; 
    width: 100%;
    /* overflow: scroll ; */
    
}
#modalCamera{
    width: 100%;
    max-width: 500px;
}
.mostrar{
    display: block !important;
    height: 100%;
    width: 100%;
    opacity: 1 !important;
    position: absolute !important;background-color: #3c29297a;
}
.precio .descuento .total{
    
}
@media (min-width: 930px) {
    .modal-body{
        height: 80% !important; 
        width: 100vw !important;
        overflow-x: hidden;
        /* margin: 10px; */
        /* overflow: scroll ; */
    }
    #modalCamera{
        height: 100% !important;
        min-width: 100vw;
        overflow: hidden;
    }
    #myModal{
        padding: 0 !important;
    }
}
</style>

