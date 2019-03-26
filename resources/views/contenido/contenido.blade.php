@extends('principal')
@section('contenido')
        @if (Auth::check())
              
            @if (Auth::user()->idrol==1)
                <template v-if="menu==0">
                   <dashboard-component></dashboard-component>
                </template>
                <template v-if="menu==1">
                    <venta-primax-component></venta-primax-component>
                </template>   
                <template v-if="menu==2">
                <venta-pecsa-component></venta-pecsa-component>
                </template>   
                <template v-if="menu==3">
                    <venta-pro-component></venta-pro-component>
                </template>   
                <template v-if="menu==4">
                    <usuario-component></usuario-component>
                </template>   
                <template v-if="menu==5">
                    <rol-component></rol-component>
                </template>   
                <template v-if="menu==6">
                    <reporte-vendedor-component></reporte-vendedor-component>
                </template>   
                <template v-if="menu==7">
                    <reporte-venta></reporte-venta>
                </template>   
                <template v-if="menu==8">
                    <cupon-component></cupon-component>
                    
                </template>
                <template v-if="menu==9">
                    <marca-component></marca-component>
                </template>
            @elseif(Auth::user()->idrol==2)
                <template v-if="menu==0">
                   <dashboard-component></dashboard-component>
                </template>
                <template v-if="menu==1">
                    <venta-primax-component></venta-primax-component>
                </template>   
                <template v-if="menu==2">
                <venta-pecsa-component></venta-pecsa-component>
                </template>   
                <template v-if="menu==3">
                    <venta-pro-component></venta-pro-component>
                </template>   
                <template v-if="menu==4">
                    <reporte-vendedor-component></reporte-vendedor-component>
                </template>   
            @else
            
        @endif
              
          @endif
       
@endsection