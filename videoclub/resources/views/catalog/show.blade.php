@extends('layouts.master')

@section('content')

<div class="row">

<div class="col-sm-4" margin-top= 25px>

<img src="{{$pelicula->poster}}" style="height:500px"/>

</div>
<div class="col-sm-8" margin-top= 25px>

<h1>{{$pelicula->title}}</h1>
<h2>Directado por {{$pelicula->director}}</h2>
<h3>{{$pelicula->year}}</h3>
<p>{{$pelicula->synopsis}}</p>

@if($pelicula->rented)
    
<p><b>Estat:</b> No disponible</p>

    <form action="{{action('CatalogController@putReturn', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger" style="display:inline">
            Devolver película
        </button>
    </form>

    <a href="{{ url('/catalog/edit/' . $pelicula->id ) }}" type="button" class="btn btn-warning" style="display:inline">Editar Pelicula</a>

    <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        
        <button type="submit" class="btn btn-danger" style="display:inline">Eliminar</button>
    </form>
        
        <a href="{{ url('/catalog/') }}" type="button" class="btn btn-light" style="display:inline">< Tornar a la llista</a>
        
    
    
    
@else
    <p><b>Estat:</b> Disponible</p>
    
    <form action="{{action('CatalogController@putRent', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary" style="display:inline">
             Alquilar
        </button>
    </form>

        <a href="{{ url('/catalog/edit/' . $pelicula->id ) }}" type="button" class="btn btn-warning">Editar Pelicula</a>

    <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger" style="display:inline">Eliminar</button>

    </form>

        <a href="{{ url('/catalog/') }}" type="button" class="btn btn-light" style="display:inline">< Tornar a la llista</a>
    
    
@endif
</div>
</div>

@stop