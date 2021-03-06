@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Añadir película
         </div>
         <div class="card-body" style="padding:30px">
            <form method="POST">
                {{ csrf_field() }}

            <div class="form-group">
               <label for="title">Title</label>
               <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>

            <div class="form-group">
                <label for="director">Adult?</label>
                <select id="adult" name="adult" id="adult" class="form-control"> 
                    <option value="false">No te edat restringida</option>
                    <option value="true">Només per majors de 18</option>
                </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir película
               </button>
            </div>

            </form>

         </div>
      </div>
   </div>
</div>


@stop