<?php

class ApiUsersTest extends TestCase {

    protected $baseUrl = 'http://localhost:8000';

    public function testApiUsersAllJson()
    {
        $this->withHeaders(['Content-Type' => 'application/json']);
        $this->get('/user/all');
        $this->isJson();
        $this->seeStatusCode(200);
    }

    public function testApiUsersAllYaml()
    {
        $this->withHeaders(['Content-Type' => 'text/yaml']);
        $this->get('/user/all');
        $this->seeStatusCode(200);
    }

    public function testApiUsersSpecificJSon()
    {
        $this->withHeaders(['Content-Type' => 'application/json']);
        $this->get('/user/1');
        $this->isJson();
        $this->seeStatusCode(200);
    }

    public function testApiUsersSpecificYaml()
    {
        $this->withHeaders(['Content-Type' => 'text/yaml']);
        $this->get('/user/1');
        $this->seeStatusCode(200);
    }

    public function testApiUsersDeleteJson()
    {
        $this->withHeaders(['Content-Type' => 'application/json']);
        $this->delete('/user/1');
        $this->isJson();
        $this->seeStatusCode(400);
    }

    public function testApiUsersDeleteYaml()
    {
        $this->withHeaders(['Content-Type' => 'text/yaml']);
        $this->delete('/user/1');
        $this->seeStatusCode(400);
    }

    public function testApiUsersInvalidOutput()
    {
        $this->get('/user/all');
        $this->seeStatusCode(400);
        $this->isJson();
    }

    public function testApiUsersInsert()
    {
        $data = [
            'firstname' => 'john',
            'lastname'  => 'doe',
            'email'     => 'jhondoe@example.com'
        ];

        $this->withHeaders(['Content-Type' => 'application/json']);
        $this->post('/user/insert', $data);
        $this->isJson();
        $this->seeJsonContains(['message' => 'Foo']);
        $this->seeStatusCode(200);
    }
}
