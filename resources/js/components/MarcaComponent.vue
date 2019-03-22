<template>
    <main class="main">
            <!-- Breadcrumb -->
            <section class="content-header">
                    <h1 >
                        <span >Balones</span>
                        <small >Modificar nombre y precio de Balon de gas</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Actualizacion de Balones</li>
                    </ol>
                </section>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                
                <div class="card">
                    
                    <!-- Listado-->
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Marca</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="marca in arrayMarca" :key="marca.id">
                                        <td>
                                            <button type="button" @click="abrirModal('marca',marca)" class="btn btn-warning btn-sm">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            </button>&nbsp;
                                        </td>
                                        <td v-text="marca.nombre"></td>
                                        <td v-text="marca.precio"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                    <!--Fin Listado-->
                    <!-- Ver ingreso -->
                    
                    <!-- fin ver ingreso -->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class=" modal-primary modal-lg " role="document">
                    <div class="modal-content container-fluid">
                        <div class="modalheader">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modalbody">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la Marca">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="precio" class="form-control" placeholder="Apellidos de la Marca">
                                    </div>
                                </div>

                                <div v-show="errorMarca" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMarca" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="actualizarMarca()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
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
                arrayMarca: [],
                buscar:'',
                nombre:'',
                precio: 0.0,
                tituloModal: 'Actualizar Balones de GAS',
                modal: 0,
                listado: 1,
                marca_id:0,
                errorMarca:'',
                errorMostrarMsjMarca:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                usuario:'',
                date: new Date(),
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            
            listarMarca(){
                let me=this;
                var url='/marca'
                axios.get(url).then(function (response) {
                  var respuesta= response.data;
                  console.log(respuesta);
                    me.arrayMarca = respuesta;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarMarca(page);
            },
            actualizarMarca(){
               if (this.validarMarca()){
                    return;
                }
                
                let me = this;

               me.precio = parseFloat(me.precio);
                console.log('nombre', me.nombre,
                    'precio', me.precio,
                    'id', me.marca_id);
                axios.put('/marca/actualizar',{
                    'nombre': me.nombre,
                    'precio': parseFloat(me.precio),
                    'id': me.marca_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMarca();
                }).catch(function (error) {
                    console.log(error);
                }); 
            },          
            cerrarModal(){
                this.modal=0;
                this.nombre='';
                this.marca='';
                this.precio=0.0;

            },  
            abrirModal(modelo, data = []){
                
                
              //console.log(data);
              this.modal=1;
              this.marca_id=data['id'];
              this.nombre = data['nombre'];
              this.precio= data['precio'];
                            
                    
            },
            validarMarca(){
                this.errorMarca=0;
                this.errorMostrarMsjMarca =[];

                if (!this.precio) this.errorMostrarMsjMarca.push("El preciono puede estar vacío.");
                if (!this.nombre) this.errorMostrarMsjMarca.push("El nombre de la marcano puede estar vacío.");

                if (this.errorMostrarMsjMarca.length) this.errorMarca = 1;

                return this.errorMarca;
            }
        },
        mounted(){
          this.listarMarca();
        },
        
    }

</script>
<style>

</style>

