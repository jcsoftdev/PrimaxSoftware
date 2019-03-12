<template>
    <div class=" ">
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
                <h2>Marca X</h2>
                <form class="datos d-flex">
                    <div class="dni">
                        <label class="" for="dni">DNI</label>
                        <!-- <input type="text" name="DNI" id="dni" pattern="[0-9]{9}" placeholder="Ingrese el Nro de DNI"> -->
                        <input id="dni" class="onlyNum"  placeholder="Ingrese DNI">

                    </div>
                    <div class="cantidad">
                        <label class="" for="cantidad" >Cantidad de balones</label>
                        <input type="text" class="onlyNum" placeholder="Cantidad de balones" name="cantidad" id="cantidad" value="1">
                        
                    </div>
                    <div class="cupon">
                        <label class="" for="cupon">Utiliza cupon?</label>
                        <input type="button" @click="abrirModal" class="btn btn-success " value="Escanear el codigo QR" data-toggle="modal" data-target="#myModal">
                    </div>
                    <div class="telefono">
                        <label class="" for="numero">Numero Celular</label>
                        <input type="tel" class="onlyNum" name="numero" pattern="[0-9]{9}" id="numero">
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
                        <tbody>
                        <tr>
                        <th style="width: 10px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Numero cupon</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigo cupon</font></font></th>
                        <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Habilitado</font></font></th>
                        <th style="width: 40px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Quitar</font></font></th>
                        </tr>
                        <tr>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lkmxfhmaoimjaexi;fjaw;omfhocwexmewo;</font></font></td>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="stopScanner" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">Cerrar</button>
                            <!-- <button type="button" @click="stopScanner" class="btn btn-default" data-dismiss="modal">Close</button> -->
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
                codigoQR: ''
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
            },
            buscarDNI(){
                axios.post('/buscarDNI', {
                    'DNI' : '71887663'
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });


            },
            scanearQR(){
                let me = this;
                me.scanner = new Instascan.Scanner({ video: document.getElementById('modalCamera') });
                me.scanner.addListener('scan', function (content) {
                    console.log(content);
                    me.codigoQR = content;
                    me.scanner.stop();
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
.content{
    position: relative;
    width: 100%;
    height: 100%;
}
.content>h1{
    text-align: center;
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
.datos{
    flex-direction: column;
    justify-content: center;
    align-self: center;
}
.datos>div{
    margin-bottom: 1rem;
}
.datos>div>label{
     width: 32%;
    /* text-align: right; */
    /* padding-right: 2rem; */
}
.datos>div>input{
    border: 1px solid #ccc;
    border-radius: .7rem;
    height: 40px;
    width: 65%;
    text-align: center;
}

.modal-dialog{
    box-sizing: border-box;
     height: 100%;
}
.modal-content{
    height: 100%;
}
.modal-body{
   /* height: 100%; */
    width: 100%;
}
#modalCamera{
    width: 100%;
}
</style>

