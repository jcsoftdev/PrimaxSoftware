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
                    <li class="active">Generador u Reporte de Codigos</li>
                </ol>
            </section>
            <div class="container-fluid">
            
                
                <div class="d-flex">
                    <form action=" " class="d-flex f-column" style="width:80%;">
                        <div class="cantidad d-flex" style="width:100%;">
                            <label class="d-inblock f-row" for="cantidad" style="display:block">Cantidad a generar</label>
                            <input v-model="cantidad" type="number" name="cantidad" id="cantidad">
                        </div>
                        <div class="vigencia d-flex" style="width:100%;">
                            <label class="d-inblock f-row" for="vigencia">Vigencia de codigos</label>
                            <input v-model="meses" type="number" name="vigencia" id="vigencia">
                        </div>
                        <input @click="crearCodigo()" type="button" value="Generar codigos">
                    </form>
                </div>
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
                                            <!-- <th scope="col">Expiracion</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  v-for="cod in codigoUsado" :key="cod.id">
                                            <th class="col" v-text="cod.id"></th>
                                            <th class="col" v-text="cod.serial"></th>
                                            <th class="col">Desactivado</th>
                                            <!-- <th class="col" v-text="cod.created_at"></th> -->
                                        </tr>
                                        <!-- <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total</strong></td>
                                        </tr> -->
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
                                            <!-- <th scope="col">Expiracion</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cod in codigoVigente" :key="cod.id">
                                            <th class="col" v-text="cod.id"></th>
                                            <th class="col" v-text="cod.serial"></th>
                                            <th class="col" >Activo</th>
                                            <!-- <th class="col" v-text="cod.created_at"></th> -->
                                        </tr>
                                        <!-- <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total</strong></td>
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
                cantidad:0,
                meses:0,
                codigoUsado:[],
                codigoVencido:[],
                codigoVigente:[]
            }
        },
        computed:{

        },
        methods:{
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
                    me.cantidad=0;
                    me.meses=0;
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
                

            }
            
        },
        
        mounted(){
            this.getCodigoUsado();    
            this.getCodigoVigente();        
        },
        
    }

</script>
<style>
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
</style>

