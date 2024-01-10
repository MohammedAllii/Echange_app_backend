<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Register extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function a_user_can_login()
    {
        $this->browse(function (Browser $browser) {
            assertSee(true);

        });
    }
}
