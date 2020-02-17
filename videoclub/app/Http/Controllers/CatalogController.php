<?php

namespace App\http\Controllers;

use Illuminate\http\Request;
use App\Movie;
use App\Review;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Notify;
use App\http\Controllers\DB;

class CatalogController extends Controller
{

	//ENCARREG DE LA PELICULA
	public function putRent($id)
	{

		$review=Review::all();
		$review = $review->where('movie_id', '=', $id);

		$pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->rented = 1;
		$return-> save();

		$movie = Movie::findOrFail($id);

		Notify::success('Has llogat la pelicula.');

		return view('catalog.show', array('pelicula'=>$movie), array('arrayReviews'=>$review));
	}

	//RETORNACIÓ DE LA PELICULA

	public function putReturn($id)
	{
		$review=Review::all();
		$review = $review->where('movie_id', '=', $id);

		$pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->rented = 0;
		$return-> save();

		$movie = Movie::findOrFail($id);

		Notify::success('Has retornat la pelicula.');

		return view('catalog.show', array('pelicula'=>$movie), array('arrayReviews'=>$review));
	}

	//ELIMINEM LA PELICULA

	public function deleteMovie($id)
	{
		$pelicula = new Movie;
		$return = $pelicula-> findOrFail($id);
		$return ->delete();

		Notify::success('Has eliminat la pelicula');

		return redirect('/catalog');
	}	

	//ENSENYAR LES DADES DE LES PELICULES

    public function getShow($id)
    {	
		$category=Category::all();
		$category= $category->where('id', '=', $id);
		$review=Review::all();
		$review = $review->where('movie_id', '=', $id);
		$pelicula=Movie::findOrFail($id);
		
        return view('catalog.show', array('pelicula'=>$pelicula), array('arrayReviews'=>$review), array('category'=>$category));	
	}
	
	//ENSENYAR EL CATALOG

    public function getIndex()				
    {	
		$pelicules=Movie::all();			
        return view('catalog.index',array('arrayPeliculas'=> $pelicules));
	}

	//BUSCADOR

	public function search(Request $request)
	{
		$nom=$request->get('search');			//AGAFO EL TEXT DEL SEARCH BAR
        $peliculas = Movie::where('title','like','%'.$nom.'%')->paginate(20);	//BUSCO DINS DE LA TAULA DE PELICULES LES PELICULES QUE EL SEU TITUL COINSIDEIXI AMB EL NOM I LES GUARDO EN UN ARRAY.
        return view('catalog.index', array('arrayPeliculas'=> $peliculas));	//RETURNO EL CATALOG DE LES PELICULES DINS UN ARRAY.
	}

	
	//CREAR//

    public function getCreate() //CARREGAR LA PAGINA DE CREAR
    {	
		$category=Category::all();

        return view('catalog.create', array('arrayCategories'=> $category));
	}

	public function postCreate(Request $request)	//GUARDAR LES DADES DE CREAR
	{	
		$pelicula=new Movie();

		$category=Category::all();
		

		$pelicula->title= $request->input('title');
		$pelicula->year= $request->input('year');
		$pelicula->director= $request->input('director');
		$pelicula->poster= $request->input('poster');
		$pelicula->synopsis= $request->input('synopsis');
		$pelicula->category_id= $request->input('category');
		$pelicula->trailer= $request->input('trailer');

		$pelicula->save();
		Notify::success('La pelicula creada correctament'); 
		return redirect("/catalog");
	}
	
	//EDITAR//
	public function getEdit($id) 		//CARREGAR LA PAGINA DE EDITAR
	{
		$category=Category::all();

        $pelicula=Movie::findOrFail($id);
		 
		return view('catalog.edit', array('pelicula'=> $pelicula), array('arrayCategories'=> $category));
	}

	public function putEdit(Request $request, $id)	
	{
		$pelicula=Movie::findOrFail($id);
		$pelicula->title= $request->input('title');
		$pelicula->year= $request->input('year');
		$pelicula->director= $request->input('director');
		$pelicula->poster= $request->input('poster');
		$pelicula->synopsis= $request->input('synopsis');
		$pelicula->category_id= $request->input('category');
		$pelicula->trailer= $request->input('trailer');

		$pelicula->save();
		Notify::success('La pelicula editada correctament.'); 
		return $this->getShow($id);
	}

	
	//REVIEWS
	
	public function postCreateR(Request $request, $id)
	{
		$user = auth()->user();

		$review=new Review();
		$review->title= $request->input('title');
		$review->stars= $request->input('stars');
		$review->review= $request->input('review');
		$review->movie_id= $id;
		$review->user_id= Auth::id();
		$review->save();
		Notify::success('La review ha sigut creada correctament');
	

		return $this->getShow($id);
	}

   

}