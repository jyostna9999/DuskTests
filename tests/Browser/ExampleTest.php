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
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'jyostna9999@gmail.com')
                ->type('password', 'Omv1nayaka')
                ->press('Login')
                ->assertPathIs('/home')
                ->assertSee('Recently added Questions');

        });
    }

    public function  testSidebarProfilePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/user/{user_id}/profile')
                ->assertSee('Recently added Questions');

        });
    }

    public function  testSidebarAllQuestionsPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/allQuestions')
                ->assertSee('Recently added Questions');

        });
    }

    public function  testSidebarCreateQuestionPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/question/create')
                ->assertSee('Recently added Questions');

        });
    }
    public function  testSidebarViewQuestionPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/home')
                ->clickLink('testing')
                ->assertSee('Recently added Questions');

        });
    }
    public function  testSidebarEditQuestionPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/home')
                ->clickLink('testing')
                ->clickLink('Edit Question')
                ->assertSee('Recently added Questions');

        });
    }

    public function  testSidebarAnswerQuestionPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/home')
                ->clickLink('testing')
                ->clickLink('Answer Question')
                ->assertSee('Recently added Questions');

        });
    }

    public function  testSidebarViewAnswerPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/home')
                ->clickLink('testing')
                ->clickLink('View')
                ->assertSee('Recently added Questions');

        });
    }
    public function  testSidebarEditAnswerPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/home')
                ->clickLink('testing')
                ->clickLink('View')
                ->clickLink('Edit Answer')
                ->assertSee('Recently added Questions');

        });
    }



}
