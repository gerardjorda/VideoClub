@extends('layouts.master')

@section('content')
<?php
   $b = false;
?>


<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
         Modificar película
         </div>
         <div class="card-body" style="padding:30px">
            <form method="POST">
            {{method_field('PUT')}}
                {{ csrf_field() }}
                

            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control"  value="{{$pelicula->title}}">
            </div>

            <div class="form-group">
                <label for="year">Año</label>
                <input type="text" name="year" id="year" class="form-control" value="{{$pelicula->year}}">
            </div>

            <div class="form-group">
                <label for="director">Director</label>
                <input type="text" name="director" id="director" class="form-control" value="{{$pelicula->director}}">
            </div>

            <div class="form-group">
                <label for="poster">Poster</label>
                <input type="text" name="poster" id="poster" class="form-control" value="{{$pelicula->poster}}">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3" value="{{$pelicula->synopsis}}">{{$pelicula->synopsis}}</textarea>
            </div>

            <div class="form-group">
                <label for="director">Categoria</label>
                <select id="adult" name="category" id="category" class="form-control"> 
                 
                  @foreach($arrayCategories as $key => $category)
                     @if($pelicula->category_id == $category->id)
                        <option selected="true" value="{{$category->id}}">{{$category->title}}</option>
                     @else
                        <option value="{{$category->id}}">{{$category->title}}</option>
                     @endif
                  @endforeach
                </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar Pelicula
               </button>
            </div>

            </form>

         </div>
      </div>
   </div>
</div>


@stop