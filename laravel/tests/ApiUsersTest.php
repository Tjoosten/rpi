<?php

class ApiUsersTest extends TestCase {

    protected $baseUrl = 'http://localhost:8000';

    /** @test */
	public function testAllUsersJson()
	{
        $output = [
            "firstname" => "Tim",
            "lastname"  => "Joosten",
            "email"     => "Topairy@gmail.com"
        ];

        $this->withHeaders(['Content-Type' => 'application/json']);
        $this->get('/user/all');
        $this->seeJson();
        $this->seeStatusCode(200);
        $this->seeJsonContains($output);
	}

    /** @test */
    public function testAllUsersYaml()
    {
        $this->withHeaders(['Content-Type' => 'text/yaml']);
        $this->get('/user/all');
        $this->seeStatusCode(200);
    }

    /** @test */
    public function testAllUsersInvalid()
    {
        $output = [
            "message" => "Invalid Content-Type header.",
            "error"   => "400",
        ];

        $this->get('/user/all');
        $this->seeStatusCode(400);
        $this->seeJsonContains($output);
    }

    public function testDeleteUsersJson()
    {
        $this->withHeaders(['Content-Type' => 'application/json']);
        $this->delete('/user/1');
        $this->seeJson();
        $this->seeStatusCode(200);
    }

    /** @test */
    public function testDeleteUsersYaml()
    {
        $this->withHeaders(['Content-Type' => "text/yaml"]);
        $this->delete('/user/2');
        $this->seeStatusCode(200);
    }


}
