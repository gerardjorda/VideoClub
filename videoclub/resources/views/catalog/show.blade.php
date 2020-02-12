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

@if(is_null($pelicula->category_id))
    <h4>Aquesta pelicula no té categoria.</h4>
@else
    <h4>Categoria: {{$pelicula->category->title}}</h4>
       
@endif


<p>{{$pelicula->synopsis}}</p>

@if($pelicula->rented)
    
<p><b>Estat:</b> No disponible</p>

<button type="button" class="btn btn-success"><img src="../../../public/img icons/heart.png" style="width:20px; margin-right:5px">Afegir a Preferits</button>


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
    
    <button type="button" class="btn btn-success"><img src="../../../public/img icons/heart.png" style="width:20px; margin-right:5px">Afegir a Preferits</button>

    <form action="{{action('CatalogController@putRent', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary" style="display:inline"><img src="../../../public/img icons/down-arrow.png" style="width:20px; margin-right:5px">
             Alquilar
        </button>
    </form>

        <a href="{{ url('/catalog/edit/' . $pelicula->id ) }}" type="button" class="btn btn-warning"><img src="../../../public/img icons/edit.png" style="width:20px; margin-right:5px">Editar Pelicula</a>
        

    <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger" style="display:inline"><img src="../../../public/img icons/close.png" style="width:20px; margin-right:5px">Eliminar</button>

    </form>

        <a href="{{ url('/catalog/') }}" type="button" class="btn btn-light" style="display:inline"><img src="../../../public/img icons/back.png" style="width:20px; margin-right:5px"> Tornar a la llista</a>
    
    
@endif
</div>
</div>

<!--COMENTARIS-->
<hr>
<h3 style="margin-top: 10px;">Comentaris</h3>
<div id="comentaris">

    @foreach( $arrayReviews as $key => $review )
    <div class="col-xs-6 col-sm-4 col-md-3" style="border-left: 5px solid grey">

        <div class="media mt-3">
            <div class="media-body">
                <h5 class="mt-0">{{$review->title}}</h5>
                <h6>{{$review->stars}}</h6>
                {{$review->review}}
                <p style="margin-top:5px; font-size: 14px; color: grey">- {{$review->created_at}}  - {{$review->user->name}}</p>
            </div>
        <hr>
        </div>

    </div>
    @endforeach

</div>
<hr>

<!--VALORACIÓ-->
<form style="margin-bottom: 10px" method="POST" action="{{action('CatalogController@postCreateR', $pelicula->id)}}">
{{ csrf_field() }}
  <div class="form-group" >
  <br>
    <label for="exampleFormControlInput1">Enviar comentari:</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Resum comentari">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Selecciona el numero de estrelles:</label>
    <select class="form-control"  name="stars" id="stars">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <textarea class="form-control" name="review" id="review" placeholder="Dona'ns la teva opinio" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-success">Valorar</button>
  <button type="button" class="btn btn-dark">Cancel·lar</button>
</form>



@stop