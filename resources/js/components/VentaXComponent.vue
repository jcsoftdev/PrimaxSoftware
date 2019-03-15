<template>
    <div class="contenido-general ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 >
            <span v-text="marca"></span>
            <small v-text="'Realice una venta de '+ marca"></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ventas</li>
          </ol>
        </section>
         <!-- Main content -->
         <div class="mi-contenido container-fluid">
             <section class="content">
                <form class="datos d-flex" >
                    <div class="dni">
                        <label class="" for="dni">DNI</label>
                        <!-- <input type="text" name="DNI" id="dni" pattern="[0-9]{9}" placeholder="Ingrese el Nro de DNI"> -->
                        <input v-model="nroDNI"  :maxlength="8" v-on:keyup="buscarDNI();" id="dni" class="onlyNum"  placeholder="Ingrese DNI" >
                        
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
                    <div class="telefono">
                        <label class="" for="numero">Numero Celular</label>
                        <input id="telefono" v-model="telefono" onKeyUp="" type="number" class="onlyNum" pattern="[0-9] {9}" >
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
                    <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">«</font></font></a></li>
                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></a></li>
                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font></a></li>
                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3</font></font></a></li>
                        <li><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">»</font></font></a></li>
                    </ul>
                    </div>
                </div>

                <form action="" class="datos" method="post">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="precio">
                            <label class="col-xs-6" for="precio">Precio</label>
                            <input v-model="precioMarca" class="col-xs-6"  type="text" name="precio" id="precio">
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
                            <input  @click="registrarVenta()" type="button" class="btn btn-info" value="Validar venta" id="vender">
                        </div>
                        
                    </div>
                    
                </form>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" @click="stopScanner" class="right btn btn-danger btn-sm " data-toggle="modal" data-target="#myModal">Cerrar &times;</button>
                                
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
                descuento:0,
                precioTotal:0,
                idmarca: '',
                idusuario: '',
                hora_fecha: '',
                errorLocalizacion: '',
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
                    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
                        return false;
                    }
                });
                ;
            },
            buscarDNI(){
                
                this.condicionDNI = 'Este DNI no puede entrar al canjeo'
                if (this.nroDNI.length == 8) {
                    axios.post('/buscarDNI', {
                    'dni' : this.nroDNI
                    }).then(response => {
                    // JSON responses are automatically parsed.
                        let me = this;
                        
                        me.nombre= response.data.nombres;
                        me.aPaterno= response.data.apellidoPaterno;
                        me.aMaterno= response.data.apellidoMaterno;
                        if (me.nombre != undefined) {
                            if (me.aPaterno.length > 0 && me.nroDNI.length == 8) {
                            me.condicionDNI = 'DNI Validado'
                            document.getElementById("cantidad").disabled = false;
                            document.getElementById("cupon").disabled = false;
                            }else{
                                document.getElementById("cantidad").disabled = true;
                                document.getElementById("cupon").disabled = true;
                            }
                        }else{
                            document.getElementById("cantidad").disabled = true;
                            document.getElementById("cupon").disabled = true;
                        }
                        
                        
                        
                    })
                    .catch(e => {
                        console.log(e);
                    });
                }else{
                    document.getElementById("cantidad").disabled = true;
                    document.getElementById("cupon").disabled = true;
                }
            },
            scanearQR(){
                let me = this;
                me.scanner = new Instascan.Scanner({ video: document.getElementById('modalCamera') });
                me.scanner.addListener('scan', function (content) {
                    
                    if (me.codigoQR.indexOf(content) == -1) {
                        me.codigoQR.push(content);
                        me.apareceAlerta('success','Escaneado');
                        console.log(content);
                    }else{
                        me.apareceAlerta('error', 'Codigo Ya existe o no valido');
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
            apareceAlerta($alert, $mensaje){
                if ($alert == 'success') {
                    this.$toasted.success($mensaje,{ 
                    theme: "bubble", 
                    position: "top-center", 
                    duration : 2000,
                    }).goAway(1500);
                }
                if ($alert == 'error') {
                    this.$toasted.error($mensaje,{ 
                    theme: "bubble", 
                    position: "top-center", 
                    duration : 2000,
                    }).goAway(1500);
                }
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
                    console.log(respuesta[0].nombre);
                    // console.log(respuesta.nombre);
                    me.marca = (respuesta[0].nombre);
                    me.precioMarca = respuesta[0].precio;
                    
                }) 
                .catch (function (error){
                    console.log(error);
                });
                
            },
            getPersonaId($dni){
                 var busqueda = '';
                busqueda = $dni;
                let me = this;
                var url = "/persona/"+busqueda;
                var id = '';
                if (busqueda.length == 8) {
                    axios.get ( url ).then( function (response){
                        var respuesta = response.data;
                        id = respuesta[0].id;
                        console.log(id);
                        
                        
                    }) 
                    .catch (function (error){
                        console.log(error);
                    });
                } else {
                    
                }
                return id;
            },
            calcularTotal(){
                var me = this;
                // console.log(me.getPersonaId('71887664'));
                // if (me.getPersonaId(me.nroDNI)) {
                    // if (me.nroDNI.length == 8 && me.nombre != null) {
                        if (parseFloat(this.cantidad)>0) {
                        me.precioTotal = parseFloat(me.precioMarca) * parseFloat(me.cantidad);
                        console.log(me.precioTotal);
                        
                        document.getElementById("vender").disabled = false;
                        }
                        else{
                            document.getElementById("vender").disabled = true;
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
                    console.log(error);
                });
                
            },
            obtenerLocalizacion(){
                if (!navigator.geolocation) {
                    this.errorLocalizacion = "Geolocalizacion no es soportada en tu navegador";
                }   
                function success(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    return  'Latitud: ' + latitude + '° Longitud: ' + longitude + '°';
                };

                function error() {
                    this.errorLocalizacion = "No se puede obtener acceso a tu localización";
                };
            },
            registrarVenta(){
                var me = this;
                
                if (me.nombre != undefined && me.getPersonaId(me.nroDNI) == null) {
                    me.registrarCliente();  
                } else{
                    console.log(typeof(me.getPersonaId(me.nroDNI)));
                    console.log('DNI: '+me.nroDNI+' ID: '+me.getPersonaId(me.nroDNI));
                }
                var idpersona= me.getPersonaId(me.nroDNI);
                me.idusuario= '';
                
                axios.post('/venta/registrar', {
                    'idpersona': idpersona,
                    'idmarca': me.marca,
                    'idusuario': 1,
                    'localizacion': this.obtenerLocalizacion(),
                    'cantidad': me.cantidad,
                    'total': me.precioTotal,
                })
                .then(function (response) {
                console.log(response);
                })
                .catch(function (error) {
                console.log(error);
                });

            },
            registrarVentaCupon(){
                
            }
        },
        mounted(){
            
            
            this.inicialConf();
            this.getMarca();
            this.onlyNum();
            this.buscarDNI();
            console.log(this.getPersonaId('71887664'));;
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

