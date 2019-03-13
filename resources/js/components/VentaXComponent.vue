<template>
    <div class="contenido-general ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ventas Marca X
            <small>Realice una venta de gas X</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ventas</li>
          </ol>
        </section>
         <!-- Main content -->
         <div class="mi-contenido container-fluid">
             <section class="content">
                <form class="datos d-flex">
                    <div class="dni">
                        <label class="" for="dni">DNI</label>
                        <!-- <input type="text" name="DNI" id="dni" pattern="[0-9]{9}" placeholder="Ingrese el Nro de DNI"> -->
                        <input v-model="nroDNI" :maxlength="8" v-on:keyup="buscarDNI()" id="dni" class="onlyNum"  placeholder="Ingrese DNI">
                        
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
                    <div class="cantidad">
                        <label class="" for="cantidad" >Cantidad de balones</label>
                        <input v-model="cantidad" type="number" class="onlyNum" placeholder="Cantidad de balones" value="1">
                        
                    </div>
                    <div class="cupon">
                        <label class="" for="cupon">Utiliza cupon?</label>
                        <input type="button" @click="abrirModal" class="btn btn-success " value="Escanear el codigo QR" data-toggle="modal" data-target="#myModal">
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
                            <input  class="col-xs-6"  type="text" name="precio" id="precio">
                        </div>
                        
                        <div class="descuento">
                            <label class="col-xs-6" for="descuento">Descuento </label>
                            <input class="col-xs-6" type="text" name="descuento" id="descuento">
                        </div>

                        <div class="total">
                            <label class="col-xs-6" for="total">Total a pagar</label>
                            <input class="col-xs-6" type="text" name="total" id="total">
                        </div>
                        <div></div>
                        <div class="vender">
                            <input type="button" class="btn btn-info" value="Validar venta">
                        </div>
                        
                    </div>
                    
                </form>
                
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button @click="stopScanner" type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Escanee el codigo QR</h4>
                            </div>
                            <div class="modal-body">
                                <video id="modalCamera">

                                </video>
                                <button type="button" @click="stopScanner" class="btn btn-danger btn-lg right" data-toggle="modal" data-target="#myModal">Cerrar</button>

                                

                                <div class="clearfix"></div>
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
import TecactusApi from 'reniec-sunat-js';
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
                tituloModal: ''
            }
        },
        methods:{

            onlyNum()
            {
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
                                
                                }
                            }
                            
                            
                            
                        })
                        .catch(e => {
                            console.log(e);
                        });
                    }
                    
                
                


            },
            scanearQR(){
                let me = this;
                me.scanner = new Instascan.Scanner({ video: document.getElementById('modalCamera') });
                me.scanner.addListener('scan', function (content) {
                    
                    if (me.codigoQR.indexOf(content) == -1) {
                        me.codigoQR.push(content);
                        console.log(content);
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
            stopScanner(){
                let me = this;
                 me.scanner.stop();
            },
            abrirModal(){
                // switch (modelo) {
                //     case "ventaX":
                //     {
                //         switch (accion) {
                //             case 'escanear':
                //             {   
                //                 this.modal = 1;
                //                 this.tituloModal = 'Escanee el codigo QR'
                //                 break
                //             } 
                //             case 'vender':
                //             {
                                
                //             }    
                        
                //         }
                        
                //     }    
                        
                // }
                this.scanearQR();
            }
        },
        mounted(){
            this.onlyNum();
            this.buscarDNI();
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

.modal-dialog{
    box-sizing: border-box;
      height: auto; 
}
.modal-content{
    height: 100%;
}
.modal-body{
    height: 100%; 
    width: 100%;
}
#modalCamera{
    width: 100%;
}
.mostrar{
    display: block !important;
    height: 100%;
    width: 100%;
    opacity: 1 !important;
    position: absolute !important;background-color: #3c29297a;
}
</style>

