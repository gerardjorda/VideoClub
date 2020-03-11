<?php

namespace Tests\Browser;
use Faker\Generator as Faker;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * 
     */
    use WithFaker;

    public function testExample() 
    {

        $this->browse(function (Browser $browser) {
    
            //ENTRANT A LA PAGINA LOGIN
            $browser->visit('/public/login')
            ->waitForText('Login')

            //FENT EL FORMULARI 
            ->type('email', 'gerardjorda23@gmail.com')
            ->type('password', '1234')
            ->press('Login')
            ->assertPathIs('/videoclub/public/catalog') //COMPROVANT QUE S'HA ENTRAT CORRECTAMENT.

            //DINS DEL CATALOG
            ->pause(2000)
            ->type('search', 'El Acudits') //BUSQUEM LA PELICULA.
            ->press('Search') //CLICKEM EN BUSCAR.

            ->pause(2000)
            ->type('search', 'El padrino') //BUSQUEM LA PELICULA.
            ->press('Search') //CLICKEM EN BUSCAR.
            
            ->pause(2000)
            ->clickLink('El padrino')

            ->pause(2000)
            ->driver->executeScript('window.scrollTo(0, 1000);');
            
            $browser->type('title', 'Comentari generat per un hacker de la URRS')
            ->select('stars', '5')
            ->type('review', 'Comentari generat per un hacker de la URRS pero en un textarea')
            ->press('Valorar')

            ->pause(2000)

            ->clickLink('Nueva película')

            ->pause(2000)
            ->type('title', $this->faker->firstName()) //TESTING
            ->pause(2000)
            ->type('year', '2020')
            ->type('director', $this->faker->firstName())
            ->type('poster', 'https://images.alphacoders.com/106/thumb-1920-1067995.jpg')
            ->type('synopsis', $this->faker->firstName())
            ->select('category', 'drama')
            ->type('trailer', 'https://www.youtube.com/embed/COQvkUmN6H8')

            ->press('Añadir película')

            ->pause(2000)

            ->press('Cerrar sesión')

            ->pause(2000);
        });


    }
}
