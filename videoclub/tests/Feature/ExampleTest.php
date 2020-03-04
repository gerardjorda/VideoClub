<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Faker\Generator as Faker;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
   
    
    public function testLoginIn() 
    {
        $credential = [
            'email' => 'gerardjorda23@gmail.com',
            'password' => '1234'
        ];

        $response = $this->post('login',$credential);
        $response->assertRedirect('/catalog');
    }
    
    
    public function testLoginOut() 
    {
        $credential = [
            'email' => '',
            'password' => ''
        ];

        $response = $this->post('login',$credential);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }


    public function testCatalog() {
        $this->withoutMiddleware();
        $response = $this->get('/catalog');
        $response->assertStatus(200);
        $response->assertViewis('catalog.index');
    }

    
    public function testCatalogShow() {
        $this->withoutMiddleware();
        $response = $this->get('/catalog/show/1');
        $response->assertViewis('catalog.show');
    }


    public function testReveiwBuida()
    {
        $response = $this->withoutMiddleware()->post('catalog/show/1',[]);
        $response->assertStatus(302);
    }


    public function testReviewDades()
    {
        $this->withoutExceptionHandling();

        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->post('catalog/show/1', [
            'title' => 'testReviewDades Pelicula',
            'review' => 'testReviewDades Pelicula',
            'stars' => 3,
            'movie_id' => 1

        ]);

        $this->assertDatabaseHas('reviews', [
            'title' => 'testReviewDades Review',
            'stars' => 3,
            'review' => 'testReviewDades Review'
        ]);
    }


    public function testEditPelicula()
    {
        $this->withoutExceptionHandling();
        $response = $this->withoutMiddleware()->put('catalog/edit/1', [
            'title' => 'testEditPelicula',
            'year' => '1998',
            'director' => 'Gerard',
            'synopsis' => 'blablabla',
            'category' => 1,
            'trailer' => 'https://www.youtube.com/embed/0dDeMbO_VPI'
        ]);

        $this->assertDatabaseHas('movies', [
            'title' => 'testEditPelicula',
            'year' => '2020',
            'director' => 'Gerard',
            'synopsis' => 'blablalba',
        ]);
    }


    public function testAddPeliculaBuida()
    {
        $response = $this->withoutMiddleware()->post('catalog/create');
        $response->assertStatus(302);
    }

    
    public function testAddPelicula()
    {
        $this->withoutExceptionHandling();

        $response = $this->withoutMiddleware()->post(route('api.add'), [
            'title' => 'testAddPelicula API',
            'year' => '1998',
            'director' => 'Gerard Jordà',
            'synopsis' => 'blalbalblabla',
            'category' => 1,
            'trailer' => 'https://www.youtube.com/embed/0dDeMbO_VPI'
        ]);

        $response->assertStatus(200);
    }


    public function testChangePeliculaAlquilada()
    {
        $response = $this->withoutMiddleware()->put(route('api.rent', ['id' => 1]));

        $response->assertStatus(200);
    }


    public function testChangePeliculaNoAlquilada()
    {
        $response = $this->withoutMiddleware()->put(route('api.return', ['id' => 1]));

        $response->assertStatus(200);
    }

}
