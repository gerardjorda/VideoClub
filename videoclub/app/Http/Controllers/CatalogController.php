<?php

namespace App\http\Controllers;

use Illuminate\http\Request;
use App\Movie;
use Notify;

class CatalogController extends Controller
{
	public function putRent($id)
	{
		$pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->rented = 1;
		$return-> save();

		$movie = Movie::findOrFail($id);

		Notify::success('Has llogat la pelicula.');

		return view('catalog.show', array('pelicula'=>$movie));
	}

	public function putReturn($id)
	{
		$pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->rented = 0;
		$return-> save();

		$movie = Movie::findOrFail($id);

		Notify::success('Has retornat la pelicula.');

		return view('catalog.show', array('pelicula'=>$movie));
	}

	public function deleteMovie($id)
	{
		$pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->delete();

		Notify::success('Has eliminat la pelicula');

		return redirect('/catalog');
	}	

    public function getShow($id)
    {
		$pelicula=Movie::findOrFail($id+1);
        return view('catalog.show', array('pelicula'=>$pelicula));
	}
		
	public function postCreate(Request $request)
	{
		$pelicula=new Movie();
		$pelicula->title= $request->input('title');
		$pelicula->year= $request->input('year');
		$pelicula->director= $request->input('director');
		$pelicula->poster= $request->input('poster');
		$pelicula->synopsis= $request->input('synopsis');
		$pelicula->save();
		Notify::success('La pelicula creada correctament'); 
		return redirect("/catalog");
	}
	
	public function putEdit(Request $request, $id)
	{
		$pelicula=Movie::findOrFail($id+1);
		$pelicula->title= $request->input('title');
		$pelicula->year= $request->input('year');
		$pelicula->director= $request->input('director');
		$pelicula->poster= $request->input('poster');
		$pelicula->synopsis= $request->input('synopsis');
		$pelicula->save();
		Notify::success('La pelicula editara correctament.'); 
		return $this->getShow($id);
	}

    public function getIndex()
    {
		$pelicules=Movie::all();
        return view('catalog.index',array('arrayPeliculas'=> $pelicules));
	}

    public function getCreate()
    {
        return view('catalog.create');
    }
	public function getEdit($id) 
	{
        $pelicula=Movie::findOrFail($id);
        return view('catalog.edit', array('pelicula'=> $pelicula));
    }

   

}