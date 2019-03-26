<template>
    <main class="main">
            <!-- Breadcrumb -->
            <section class="content-header">
                    <h1 >
                        <span >Ingresos Por Vendedor</span>
                        <small >Consulte sus ingreso de cada vendedor </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Reportes</li>
                    </ol>
                </section>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="datepicker">
                    <label >Fecha</label>
                        <datepicker v-model="date" name="fecha" 
                            @opened="datepickerAbierto" 
                            @selected="fechaSeleccionada" 
                            @closed="datepickerCerrado"
                            :format="customFormatter"
                        ></datepicker>
                </div>
                <template>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header">
                            <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reporte de ingresos Primax Gas</font></font></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Nombre </th>
                                            <th scope="col">Balones Vendidos</th>
                                            <th scope="col">Total a cobrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="primax in ArrayGas1" :key="primax.idusuario">
                                            <th scope="col" v-text="primax.idusuario"></th>
                                            <th scope="col" v-text="primax.usuario"></th>
                                            <th scope="col" v-text="primax.nombre + ' ' + primax.apellidos"></th>
                                            
                                            <th scope="col" v-text="primax.CantVenta"></th>
                                            <th scope="col" class="label label-warning" v-text="'S/ '+primax.IngresoT"></th>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total</strong></td>
                                            <td class="" >Primax Gas</td>
                                            <td class="badge bg-green" v-text="'S/ '+TotalPago[0]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </template>

                <template>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header">
                            <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reporte de ingresos RepSol Gas</font></font></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Nombre </th>
                                            <th scope="col">Balones Vendidos</th>
                                            <th scope="col">Total a cobrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="pecsa in ArrayGas2" :key="pecsa.idusuario">
                                            <th scope="col" v-text="pecsa.idusuario"></th>
                                            <th scope="col" v-text="pecsa.usuario"></th>
                                            <th scope="col" v-text="pecsa.nombre + ' ' + pecsa.apellidos"></th>
                                            <th scope="col" v-text="pecsa.CantVenta"></th>
                                            <th scope="col" class="label label-warning" v-text="'S/ '+pecsa.IngresoT"></th>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total</strong></td>
                                            <td class="" >Pecsa Gas</td>
                                            <td class="badge bg-green" v-text="'S/ '+TotalPago[1]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </template>

                <template>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header">
                            <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reporte de ingresos Pro Gas</font></font></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Nombre </th>
                                            <th scope="col">Balones Vendidos</th>
                                            <th scope="col">Total a cobrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="pro in ArrayGas3" :key="pro.idusuario">
                                            <th scope="col" v-text="pro.idusuario"></th>
                                            <th scope="col" v-text="pro.usuario"></th>
                                            <th scope="col" v-text="pro.nombre + ' ' + pro.apellidos"></th>
                                            <th scope="col" v-text="pro.CantVenta"></th>
                                            <th scope="col" class="label label-warning" v-text="'S/ '+pro.IngresoT"></th>
                                            
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total</strong></td>
                                            <td class="">Pro Gas</td>
                                            <td class="badge bg-green" v-text="'S/ '+TotalPago[2]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </template>
                
                <!-- Fin ejemplo de tabla Listado -->
            </div>
    </main>
</template>

<script>
    import Toasted from 'vue-toasted';
    import { async } from 'q';
    import moment from "moment";
   
    
    export default {
        data() {
            return{
                // primax
                ArrayGas1: [],
                // repsol
                ArrayGas2:[],
                // progas
                ArrayGas3:[],
                VendedoresPagos: [

                ],
                TotalPago:[],
                date: new Date()

            }
        },
        computed:{
            obtenerFech(){

                this.date = Math.round(Date.now() / 1000)
            }
        },
        methods:{
            obtenerDetalles(date){
                var me = this;
                axios.get('/venta/detalleVendedor?fecha='+date)
                .then(function (response) {
                    // handle success
                    console.log('/venta/detalleVendedor?'+date);
                    let datos = response.data;
                    var totalPrimax = 0;
                    var totalPecsa = 0;
                    var totalPro = 0;
                    for (let i = 0; i < datos.length; i++) {
                        if (datos[i].marca =='Primax Gas') {
                            totalPrimax += datos[i].IngresoT
                            me.ArrayGas1.push(datos[i])
                        } else if(datos[i].marca =='Pecsa Gas'){
                            totalPecsa += datos[i].IngresoT
                            me.ArrayGas2.push(datos[i])
                        }else if(datos[i].marca =='Pro Gas'){
                            totalPro += datos[i].IngresoT
                            me.ArrayGas3.push(datos[i])
                        }
                        
                    }
                    me.TotalPago.push(totalPrimax.toFixed(2))
                    me.TotalPago.push(totalPecsa.toFixed(2))
                    me.TotalPago.push(totalPro.toFixed(2))
                    console.log(me.ArrayGas1);
                    console.log(me.ArrayGas2);
                    console.log(me.ArrayGas3);
                    console.log(me.TotalPago);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            customFormatter(date) {
                    return moment(date).format('DD MMM YYYY');
            },
            datepickerAbierto: function() {
                console.log('El datepicker ha sido abierto');
            },
            fechaSeleccionada: function() {
                var me = this;
                console.log(me.date);
                // this.buscarVenta(1,this.usuario,this.date);
                me.ArrayGas1 = []
                me.ArrayGas2 = []
                me.ArrayGas3 = []
                me.TotalPago = []
            },
            datepickerCerrado: function() {
                console.log('El datepicker ha sido cerrado');
                
                this.obtenerDetalles(this.customFormatter(this.date))
                console.log(this.date);
            },
        },
        mounted(){
            this.obtenerDetalles(this.customFormatter(this.date));
        },
        
    }

</script>
<style>
.box-header{
    text-align: center;
    background: #01a7e5;
    color: white;
    font-weight: bold !important;
    text-transform: uppercase;
}
.badge{
    margin-top: .3em;
    margin-bottom: .3em;
}
.label{
    display: inline-block;
    width: 90%
}

</style>

