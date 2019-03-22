<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Ventas
                    </div>
                    <!-- Listado-->
                    <template v-if="listado==1">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group  d-flex">
                                    <div class="vendedor d-flex">
                                        <label for="vendedor">Vendedores</label>
                                        <select @change="buscarPorVendedor(1, getVendedor())" class="form-control col-md-3"  id="vendedor" name="vendedor">
                                            <option   v-for="vendedor in vendedores" :key="vendedor.id" v-text="vendedor" >
                                                
                                            </option>
                                        
                                        </select>
                                        <!-- <input type="text" v-model="buscar" @keyup.enter="listarVenta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar"> -->
                                        <!-- <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> -->
                                    </div>

                                    <div class="fecha">
                                        <label >Fecha</label>
                                        <datepicker ></datepicker>
                                        <!-- <datepicker @opened="datepickerAbierto" 
                                        @selected="fechaSeleccionada" 
                                        @closed="datepickerCerrado"></datepicker> -->
                                        <!-- <datetime @click="customFormatter(date)"  v-model="date"  ></datetime> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Vendedor</th>
                                        <th>Cliente</th>
                                        <th>DNI</th>
                                        <th>Balon de gas</th>
                                        <th>Cantidad</th>
                                        <th>Precio Total</th>
                                        <th>Descuento</th>
                                        <th>Precio de ingreso</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                        <td>
                                            <button type="button" @click="verdetalle(detalle.id)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button>
                                        </td>
                                        <td v-text="detalle.usuario"></td>
                                        <td v-text="detalle.nombre"></td>
                                        <td v-text="detalle.dni"></td>
                                        <td v-text="detalle.marca"></td>
                                        <td v-text="detalle.cantidad"></td>
                                        <td v-text="detalle.precio"></td>
                                        <td v-text="detalle.descuento"></td>
                                        <td v-text="detalle.total"></td>
                                        <td v-text="detalle.fecha"></td>
                                    </tr>
                                    <!-- <tr >
                                        <td>
                                            <button type="button"  class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> &nbsp;
                                            <button type="button"  class="btn btn-info btn-sm">
                                            <i class="icon-doc"></i>
                                            </button>
                                        </td>
                                        <td >juancarlos</td>
                                        <td >Miguel</td>
                                        <td >Primax</td>
                                        <td >4</td>
                                        <td >120</td>
                                        <td >5</td>
                                        <td >115</td>
                                        <td >hoy</td>
                                    </tr>                                 -->
                                </tbody>
                            </table>
                        </div>
                        <!-- <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Ver ingreso -->
                    
                    <!-- fin ver ingreso -->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        </main>
</template>

<script>
    import Toasted from 'vue-toasted';
    import { async } from 'q';

   

    // you can also pass options, check options reference below
    
    // import VeeValidate from 'vee-validate';
    // Vue.use(VeeValidate);
    // you can call like this in your component
    
    export default {
        data() {
            return{
                vendedores: [
                    ''
                ],
                buscar:'',
                listado: 1,
                pagesNumber: 0,
                arrayDetalle:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                date : '',
            }
        },
        
        methods:{
            customFormatter(date) {
                    return moment(date).format('D MMMM YYYY');
                    console.log(date);
            },
            datepickerAbierto: function() {
                console.log('El datepicker ha sido abierto');
            },
            fechaSeleccionada: function() {
                console.log('Una fecha ha sido seleccionada');
            },
            datepickerCerrado: function() {
                console.log('El datepicker ha sido cerrado');
            },
            listarVendedores(){
                var me =this;
                axios.get('/user/vendedor')
                    .then(function (response) {
                        var datos = response.data;
                        console.log(datos);
                        for (let i = 0; i < datos.length; i++) {
                        
                            me.vendedores.push(datos[i].usuario);
                            
                        }
                        
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getVendedor(){
                var vendedor = document.getElementById("vendedor").value;
                console.log(vendedor);
                return vendedor;
            },
            buscarPorVendedor(page,buscar){
                let me=this;
                var url='/venta/detalle?page=' + page + '&buscar='+ buscar ;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted(){
            
            this.listarVendedores();
            this.buscarPorVendedor(1,'');
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
    height: 40px !important;
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
.input-group{
    justify-content: space-between;
    justify-content: center;
    align-items: center;
    }
.vendedor{
    padding: .2rem;
    margin: .3em;
}
.vendedor label{
    display: block;
    padding: .2rem;
    margin: .3em;
    margin-right: 20px;
    width: 10vw;
    display: flex;
    justify-content: center;
    text-align: center;
    align-items: center;
    vertical-align: center;
}
.vendedor select{
    display: block;
    /* padding: .2rem;
    margin: .3em; */
    width: 25vw !important;
    height: 40px;
}
.fecha{
    display: flex;
    justify-content: center;
    text-align: center;
    align-items: center;
    height: 100%;
}
.vdatetime{
    width: 30vw;
}
</style>

