<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LatestQuestionsSidebarTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testSidebarHomePage()
    {

        $user = factory(User::class)->make();
        $user->save();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/home')
                ->assertSee('Recently added Questions');
        });
    }

    public function  testAddQuestion()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->clickLink('Create a Question')
                ->assertSee('Create Question')
                ->type('body','testing')
                ->press('Save')
                ->assertPathIs('/home')
                ->assertSee('IT WORKS!');
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

    public function  testAddAnswer()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit ('/home')
                ->clickLink('testing')
                ->clickLink('Answer Question')
                ->type('body','This is new answer')
                ->press('Save')
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
