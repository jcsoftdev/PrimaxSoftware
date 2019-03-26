<template>
  <div class="container-fluid">
    <section class="content-header">
        <h1 >
            <span >DashBoard</span>
            <small >Estadicticas en Graficos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <div class="graficos g-center">
      <div class="col-md-6 ">
        <canvas id="pie-chart" class="pie-chart"></canvas>
      </div>
      <div class="col-md-6 r">
        <canvas id="bar-chart" class="pie-chart"></canvas>
      </div>
    </div>
    <!-- <div class="col-md-6">
      <canvas id="pie-chart" class="pie-chart"></canvas>
    </div> -->
    
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
                "datasets":[
                  { "label":"Ingreso en Soles",
                    "data":[me.TotalPago[0],me.TotalPago[1],me.TotalPago[2]],
                    "fill":false,
                    "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)"],
                    "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(54, 162, 235)"],
                    "borderWidth":1
                  }
                ]
              },
              options: {
                title: {
                  display: true,
                  text: 'Ingresos en soles'
                }
              }
          });
          new Chart(document.getElementById("bar-chart"),
          {   "type":"bar",
              "data":
              {"labels":["Primax", "Pecsa", "ProGAs"],
                "datasets":[
                  { "label":"Ingreso en Soles",
                    "data":[me.TotalPago[0],me.TotalPago[1],me.TotalPago[2]],
                    "fill":false,
                    "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)"],
                    "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(54, 162, 235)"],
                    "borderWidth":1
                  }
                ]
              },
              "options":{
                "scales":{
                  "yAxes":[
                    {
                      "ticks":{"beginAtZero":true}
                    }
                  ]
                }
              }
          });
          // new Chart(document.getElementById("bar-chart"), {
          //     type: 'bar',
          //     data: {
          //       labels: ["Primax", "Pecsa", "ProGAs"],
          //       datasets: [
          //         {
          //           label: "Ventas",
          //           backgroundColor: ["rgba(255, 99, 132, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)"],
          //           data: [me.TotalPago[0],me.TotalPago[1],me.TotalPago[2]]
          //         }
          //       ]
          //     },
          //     options: {
          //       legend: { display: false },
          //       title: {
          //         display: true,
          //         text: 'Ingresos en soles'
          //       }
          //     }
          // });
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
<style>
th,td{
        text-align: center;
    }
  
  @media (min-width: 500px) {
  .g-center{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: nowrap;
  }
}
</style>

