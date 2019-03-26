<template>
  <div class="container-fluid">
    <div class="col-md-6">
      <canvas id="pie-chart" class="pie-chart"></canvas>
    </div>
    <div class="col-md-6">
      <canvas id="pie-chart" class="pie-chart"></canvas>
    </div>
    <div class="col-md-6">
      <canvas id="pie-chart" class="pie-chart"></canvas>
    </div>
    
  </div>
</template>
<script>
export default {
    data(){
      return{
        progas:0,
        primax:0,
        pecsa:0,
        ArrayGas1: [],
        // Pecsa
        ArrayGas2:[],
        // progas
        ArrayGas3:[],
        TotalPago:[]
      }
    },
    methods:{
      getVentasBalones(){
        var me = this;
          new Chart(document.getElementsByClassName("pie-chart"), {
              type: 'pie',
              data: {
                labels: ["Primax", "Pecsa", "ProGAs"],
                datasets: [{
                  label: "Population (millions)",
                  backgroundColor: ["#55ddff", "#8e5ea2","#3cba9f"],
                  data: [me.TotalPago[0],me.TotalPago[1],me.TotalPago[2]]
                }]
              },
              options: {
                title: {
                  display: true,
                  text: 'Las ventas de cada balon de gas'
                }
              }
          });
      },
      obtenerDetalles(){
          var me = this;
          axios.get('/venta/detalleVendedor')
          .then(function (response) {
              // handle success
              let datos = response.data;
              var totalPrimax = 0;
              var totalPecsa = 0;
              var totalPro = 0;
              for (let i = 0; i < datos.length; i++) {
                  if (datos[i].marca =='Primax Gas') {
                      totalPrimax += datos[i].IngresoT
                  } else if(datos[i].marca =='Pecsa Gas'){
                      totalPecsa += datos[i].IngresoT
                  }else if(datos[i].marca =='Pro Gas'){
                      totalPro += datos[i].IngresoT
                  }
                  
              }
              me.TotalPago.push(totalPrimax.toFixed(2));
              me.TotalPago.push(totalPecsa.toFixed(2));
              me.TotalPago.push(totalPro.toFixed(2));
              console.log(me.ArrayGas1);
              console.log(me.ArrayGas2);
              console.log(me.ArrayGas3);
              console.log(me.TotalPago);
              me.getVentasBalones();
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
    computed:{
      
    
    },
    mounted(){
      this.obtenerDetalles();
      
      }
}
</script>
