<?php

namespace Tests\Browser;

use function foo\func;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    public function  testSidebar()
    {
        $this->browse(function (Browser $browser, $secondBrowser, $thirdBrowser) {
            $browser->visit('/login')
                ->type('email', 'jyostna9999@gmail.com')
                ->type('password', 'Omv1nayaka')
                ->press('Login')
                ->assertPathIs('/home')
                ->assertSee('Recently added Questions');

            $secondBrowser ->visit('/login')
                ->type('email', 'jyostna9999@gmail.com')
                ->type('password', 'Omv1nayaka')
                ->press('Login')
                ->visit ('/allQuestions')
                ->assertSee('Recently added Questions');

            $thirdBrowser ->visit('/login')
                ->type('email', 'jyostna9999@gmail.com')
                ->type('password', 'Omv1nayaka')
                ->press('Login')
                ->visit ('/question/create')
                ->assertSee('Recently added Questions');

        });
    }

}
