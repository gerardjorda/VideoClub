@extends('layouts.master')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top:10px">
            <div class="pull-left">
                <h2>Categories</h2>
            </div>
            <div class="pull-right">
    
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Adult</th>
            <th colspan="3">Action</th>
        </tr>
    @foreach ($arrayCategories as $category)
    <tr>
        <td>{{$category->title}}</td>
        <td>{{ $category->description }}</td>
      
    @if($category->adult)
    <td>+18</td>

    @else
    <td>No te edat minima</td>

    @endif
   
        <td>
            <a   href="{{ url('/category/' . $category->id) }}" type="button" class="btn btn-succes">Mostra </a>
        </td>
        
    
        <td>
            <a   href="{{ url('/category/' . $category->id .'/edit') }}" type="button" class="btn btn-warning">Edita </a>
        </td>
    
        <td>
        <form action="{{action('CategoryController@destroy', $category->id)}}" method="post" style="display:inline">  
        {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </tr>
    @endforeach

    
    </table>
        <a   href="{{url('/category/create')}}" type="button" class="btn btn-success"> Nova Categoria </a>
@stop