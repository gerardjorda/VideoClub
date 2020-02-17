<?php

namespace App\Http\Controllers;
use App\Category;
use App\Movie;
use Illuminate\Http\Request;
use App\Review;
use Notify;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.index',array('arrayCategories'=> $categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)    //CARREGAR LA PAGINA DE CREAR CATEGORIA.
    {
        return view('categories.create');
       
    }

    public function pcreate(Request $request)   //CREACIO DE LA CATEGORIA AL RECOLLIR LES DADES DE LA PAGINA CATEGORIA.
    {
        $category=new Category();
		$category->title= $request->input('title');
        $category->description= $request->input('description');
        
        if($request->input('adult')=="false")
        {
            $category->adult= false;
        }
        if($request->input('adult')=="true")
        {
            $category->adult= true;
        }
		
		$category->save();
		Notify::success('La categoria a sigut creada correctament'); 
		return redirect("/category");
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     //ENSENYAR TOTES LES PELICULAS QUE TINGUIN LA CATEGORIA CORRESPONENT.
    public function show($id)
    {
		$pelicula=Movie::all();
        $pelicula=$pelicula->where('category_id', '=', $id);
        
        return view('categories.show', array('arrayPeliculas'=>$pelicula));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)   //CARREGAR LA PAGINA DE EDICIO DE PELICUAL
    {
        $category=Category::findOrFail($id);    
        return view('categories.edit', array('category'=> $category));
    }

    public function pedit(Request $request, $id)    //RECOLLIDA DE LES DADES I LA EDICIO DE LA PELICULA.
    {
        $category=Category::findOrFail($id);
		$category->title= $request->input('title');
        $category->description= $request->input('description');
        
        if($request->input('adult')=="false")
        {
            $category->adult= false;
        }
        if($request->input('adult')=="true")
        {
            $category->adult= true;
        }
		
		$category->save();
		Notify::success('La categoria a sigut editada correctament'); 
		return redirect("/category");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //ELIMINACIÓ DE LA CATEGORI
    public function destroy($id)    
    {
        $category = new Category;
		$return = $category-> findOrFail($id);
		$return ->delete();

		Notify::success('Has eliminat la categoria');

		return redirect('/category');
    }
}
