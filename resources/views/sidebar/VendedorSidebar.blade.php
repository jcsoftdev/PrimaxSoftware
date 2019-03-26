<ul class="sidebar-menu" data-widget="tree">
          
  <li @click="menu=0" class="treeview">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Dashboard</span>
      <!-- <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span> -->
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa  fa-shopping-cart"></i>
      <span>Ventas</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    
    <ul class="treeview-menu">
      <li @click="menu=1"><a href="#"><i class="fa fa-circle-o"></i> Venta de Primax Gas</a></li>
      <li @click="menu=2"><a href="#"><i class="fa fa-circle-o"></i> Venta de Pecsa Gas</a></li>
      <li @click="menu=3"><a href="#"><i class="fa fa-circle-o"></i> Venta de Pro Gas</a></li>
    </ul>
    
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-file-text"></i> <span>Reportes</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
     
      <li @click="menu=4"><a href="#"><i class="fa fa-circle-o"></i> Reporte por Vendedor</a></li>
    </ul>
  </li>
  
</ul>