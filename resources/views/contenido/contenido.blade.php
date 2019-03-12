@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <h1> Dashboard </h1>
    </template>
    <template v-if="menu==1">
        <venta-x-component></venta-x-component>
    </template>   
    <template v-if="menu==2">
        <h1> CONTENIDO 2 </h1>
    </template>   
    <template v-if="menu==3">
        <h1> CONTENIDO 3 </h1>
    </template>   
    <template v-if="menu==4">
        <h1> CONTENIDO 4 </h1>
    </template>   
    <template v-if="menu==5">
        <h1> CONTENIDO 5 </h1>
    </template>   
    <template v-if="menu==6">
        <h1> CONTENIDO 6 </h1>
    </template>   
@endsection