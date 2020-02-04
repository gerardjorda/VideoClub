<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Movie::all() );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelicula=new Movie();
		$pelicula->title= $request->input('title');
		$pelicula->year= $request->input('year');
		$pelicula->director= $request->input('director');
		$pelicula->poster= $request->input('poster');
		$pelicula->synopsis= $request->input('synopsis');
        $pelicula->save();
        
		return response()->json( ['error' => false, 'msg' => 'La película ha sigut creada.' ] );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Movie::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelicula=Movie::findOrFail($id);
		$pelicula->title= $request->input('title');
		$pelicula->year= $request->input('year');
		$pelicula->director= $request->input('director');
		$pelicula->poster= $request->input('poster');
		$pelicula->synopsis= $request->input('synopsis');
        $pelicula->save();
        
		return response()->json( ['error' => false, 'msg' => 'La película ha sigut editada.' ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->delete();

		return response()->json( ['error' => false, 'msg' => 'La película ha sigut eliminada.' ] );
    }

    public function putRent($id) {
        $m = Movie::findOrFail( $id );
        $m->rented = true;
        $m->save();
        return response()->json( ['error' => false, 'msg' => 'La película se ha marcat como alquilada.' ] );
    }

    public function putReturn($id) 
    {
        $m = Movie::findOrFail($id);
        $m->rented = false;
        $m->save();
        return response()->json( ['error' => false,
                              'msg' => 'La película se ha marcat com a no alquilada' ] );
    }

}
