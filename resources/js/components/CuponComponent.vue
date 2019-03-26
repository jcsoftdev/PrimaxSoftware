<template>
    <main class="main">
        <!-- Breadcrumb -->
            <section class="content-header">
                <h1 >
                    <span >Codigos</span>
                    <small >Cree Codigos y supervise Actividad</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Generador y Reporte de Codigos</li>
                </ol>
            </section>
            <div class="container-fluid">
                <!-- formulario para creaar los cupones -->
                <div class="formulario d-flex">
                    <div class=" col-sm-6 d-flex">
                        <form action=" " class="d-flex f-column" style="width:80%;">
                            <div class="cantidad d-flex" style="width:100%;">
                                <label class="d-inblock f-row" for="cantidad" style="display:block">Cantidad a generar</label>
                                <input v-model="cantidad" v-on:keyup="btnOn" type="number" name="cantidad" id="cantidad" value="">
                            </div>
                            <div class="vigencia d-flex" style="width:100%;">
                                <label class="d-inblock f-row" for="vigencia">Vigencia de codigos</label>
                                <input v-model="meses" v-on:keyup="btnOn" type="number" name="vigencia" id="vigencia" value="">
                            </div>
                            <div class="btn-generar d-flex">
                                <label for=""></label>
                                <input @click="crearCodigo()"  id="btn-generar" style="width:100%" class="btn btn-info" type="button" value="Generar codigos">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end formulario para creaar los cupones -->
                <template class="report">
                <div class="col-md-12">
                        <div class="box ">
                            <div class="box-header">
                                <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Reporte Cupones</font></font></h3>
                            </div>
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">Usados</th>
                                            <th scope="col">Vencidos</th>
                                            <th scope="col">Vigentes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="col" v-text="cantUsado"></th>
                                            <th class="col" v-text="cantVencida"></th>
                                            <th class="col" v-text="cantVigente"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                </div>
                </template>
                <template>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header">
                            <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigos Usados</font></font></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">codigo</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Expiracion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  v-for="cod in codigoUsado" :key="cod.id">
                                            <td class="col" v-text="cod.id"></td>
                                            <td class="col" v-text="cod.serial"></td>
                                            <td class="col">Desactivado</td>
                                            <th class="col" v-text="cod.expiracion"></th>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong></strong></td>
                                            <td><button @click="activar" class="btn btn-warning">Activar</button></td>
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
                            <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigos Vencidos</font></font></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">codigo</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Vencimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  v-for="cod in codigoVencido" :key="cod.id">
                                            <td class="col" v-text="cod.id"></td>
                                            <td class="col" v-text="cod.serial"></td>
                                            <td class="col">Vencido</td>
                                            <th class="col" v-text="cod.expiracion"></th>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong></strong></td>
                                            <td><button @click="actualizar" class="btn btn-warning">Actualizar</button></td>
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
                            <h3 class="box-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codigos Vigente</font></font></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding  table-responsive">
                                <table class="table table-sm table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">codigo</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Expiracion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cod in codigoVigente" :key="cod.id">
                                            <td class="col" v-text="cod.id"></td>
                                            <td class="col" v-text="cod.serial"></td>
                                            <td class="col" >Activo</td>
                                            <th class="col" v-text="cod.expiracion"></th>
                                        </tr>
                                        <!-- <tr style="background-color: #CEECF5;">
                                            <td colspan="2" align="right"><strong>Activar</strong></td>
                                            <td><button>Activar</button></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </template>
            
            </div>
    </main>
</template>

<script>
   

    // you can also pass options, check options reference below
    
    // import VeeValidate from 'vee-validate';
    // Vue.use(VeeValidate);
    // you can call like this in your component
    
    export default {
        data() {
            return{
                cantidad:'',
                meses:'',
                codigoUsado:[],
                codigoVencido:[],
                codigoVigente:[],
                cantUsado:0,
                cantVigente:0,
                cantVencida:0,
            }
        },
        computed:{

        },
        methods:{
            inicialConf(){
                document.getElementById("btn-generar").disabled = true;
            },
            btnOn(){
                if (this.cantidad>0 && this.meses>0) {
                    document.getElementById("btn-generar").disabled = false;
                }else{
                    document.getElementById("btn-generar").disabled = true;
                }
            },
            crearCodigo(){
                var me = this
                axios.post('/cupon/crear', {
                    cantidad: this.cantidad,
                    meses: this.meses,
                })
                .then(function (response) {
                    console.log(response.data);
                    Swal.fire(
                    'Se creó los códigos',
                    'Se crearon '+me.cantidad +' codigos Satisfactoriamente',
                    'success'
                    )
                    me.cantidad='';
                    me.meses='';
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCodigoUsado(){
                var me = this;
                axios.get('/cupon?condicion='+0)
                .then(function (response) {
                    // handle success
                    var datos = response.data;
                    me.codigoUsado = []
                    for (let i = 0; i < datos.length; i++) {
                        
                        
                        me.codigoUsado.push(datos[i])
                    }
                    console.log(datos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
                

            },
            getCodigoVigente(){
                var me = this;
                axios.get('/cupon?condicion='+1)
                .then(function (response) {
                    // handle success
                    var datos = response.data;
                    me.codigoVigente =[]
                    for (let i = 0; i < datos.length; i++) {
                        
                        
                        me.codigoVigente.push(datos[i])
                    }
                    console.log(datos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
                

            },
            getCodigoVencido(){
                var me = this;
                axios.get('/cupon?condicion='+2)
                .then(function (response) {
                    // handle success
                    var datos = response.data;
                    me.codigoVencido = []
                    for (let i = 0; i < datos.length; i++) {
                        
                        
                        me.codigoVencido.push(datos[i])
                    }
                    console.log(datos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
                

            },
            getCantActivo(){
                var me = this;
                axios.get('/cupon/cantidad?condicion=1')
                .then(function (response) {
                    // handle success
                    var datos = response.data;
                    me.cantVigente=datos;
                    console.log(datos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            getCantUsado(){
                var me = this;
                axios.get('/cupon/cantidad?condicion=0')
                .then(function (response) {
                    // handle success
                    var datos = response.data;
                    me.cantUsado=datos;
                    console.log(datos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            getCantVencida(){
                var me = this;
                axios.get('/cupon/cantidad?condicion=2')
                .then(function (response) {
                    // handle success
                    var datos = response.data;
                    me.cantVencida = datos;
                    console.log(datos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            activar(){
                var me = this;
                axios.put('/cupon/activar')
                .then(function (response) {
                    // handle success
                    
                    me.getCodigoVencido();
                    me.getCodigoUsado();    
                    me.getCodigoVigente(); 
                    
                    me.getCantActivo();
                    me.getCantUsado();
                    me.getCantVencida();
                    Swal.fire(
                        'Good job!',
                        'Se activaron los cupones!',
                        'success'
                    )
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            actualizar(){
                var me = this;
                Swal.fire({
                    title: 'Escribe cantidad de mese',
                    input: 'number',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Acctualizar',
                    showLoaderOnConfirm: true,
                    preConfirm: (meses) => {
                        axios.put('/cupon/actualizar?meses='+meses)
                        .then(function (response) {
                            Swal.fire(
                                'Good job!',
                                'Se actualizaron los cupones!',
                                'success'
                            )
                            me.codigoVencido = []
                            me.codigoUsado = []
                            me.codigoVigente = []
                            me.getCodigoVencido();
                            me.getCodigoUsado();    
                            me.getCodigoVigente(); 
                            
                            me.getCantActivo();
                            me.getCantUsado();
                            me.getCantVencida();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                            `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                        title: `${result.value.login}'s avatar`,
                        imageUrl: result.value.avatar_url
                        })
                    }
                })
            },
            desactivaInf(){
                var me = this;
                axios.put('/cupon/desactivaInf')
                .then(function (response) {
                    // Swal.fire(
                    //     'Good job!',
                    //     'Se actualizaron los cupones!',
                    //     'success'
                    // )
                    
                    me.getCodigoVencido();
                    me.getCodigoUsado();    
                    me.getCodigoVigente(); 
                    
                    me.getCantActivo();
                    me.getCantUsado();
                    me.getCantVencida();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            vencimiento(){
                var me = this;
                axios.put('/cupon/vencimiento')
                .then(function (response) {
                    if (response.data.lenght>0) {
                            Swal.fire(
                            'Good job!',
                            'Se Vencieron los cupones!',
                            'error'
                        )
                    }
                    
                    me.getCodigoVencido();
                    me.getCodigoUsado();    
                    me.getCodigoVigente();
                    
                    me.getCantActivo();
                    me.getCantUsado();
                    me.getCantVencida(); 
                            
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            }
            
        },
        
        mounted(){
            this.codigoVencido = []
                    this.codigoUsado = []
                    this.codigoVigente = []
            this.desactivaInf()
            this.getCodigoVencido();
            this.getCodigoUsado();    
            this.getCodigoVigente();        
            this.btnOn();
            this.getCantActivo();
            this.getCantUsado();
            this.getCantVencida();
            this.desactivaInf();
            this.vencimiento();
        },
        
    }

</script>
<style>
    th{
        text-align: center;
    }   
    .d-flex{
        display: flex;
        justify-content: center;
        align-content: center;
        align-items: center;
    }
    .d-inblock{
        display: inline-block;
    }
    .f-column{
        flex-wrap: nowrap;
        flex-direction: column !important;
    }
    .f-row{
        flex-wrap: nowrap;
        flex-direction: row !important;
    }
    .btn-generar{
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .report{
        display: block;
    }
</style>

