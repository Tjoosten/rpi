<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthencationTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function testBlockUserHandling()
    {
        $this->visit('/block/1');
        $this->assertResponseOk();

    }

    public function testUpdatePriviledges()
    {
        $this->visit('/upgrade/1');
        $this->assertResponseOk();
    }

    public function testDowngradePriviledges()
    {

        $this->visit('downgrade/1');
        $this->assertResponseOk();
    }

    public function testDeleteUserHandling()
    {
        $this->visit('/delete/1');
        $this->assertResponseOk();
    }

    public function testUnblockUserHandling()
    {
        $this->visit('/unblock/1');
        $this->assertResponseOk();
    }

    public function testRegisterForm()
    {
        $this->visit('/register');
        $this->type('Tim', 'firstname');
        $this->type('Joosten','lastname');
        $this->type('Jhon@example.be','email');
        $this->press(Lang::get("auth.buttonRegister"));
        $this->assertResponseOk();
    }
}