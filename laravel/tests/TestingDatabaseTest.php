<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TestingDatabaseTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function testUserTable()
    {
        $this->seeInDatabase('users', [ 'id' => 1 ]);
        $this->seeInDatabase('users', [ 'id' => 2 ]);
    }

    public function testKloekecodeTable()
    {
        $this->seeInDatabase('kloekecode', [ 'id' => 1 ]);
    }
}