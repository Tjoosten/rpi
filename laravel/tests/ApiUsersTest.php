<?php

class ApiUsersTest extends TestCase
{
    private $insertArray = [
        'firstname' => 'foo',
        'lastname'  => 'bar',
        'email'     => 'foobar@domain.net'
    ];

    private $mimeJson = ['Content-Type' => 'application/json'];
    private $mimeYaml = ['Context-Type' => 'application/yaml'];

    public function testPostUserMethodJson()
    {
        $this->post('/user/insert', $this->insertArray, $this->mimeJson);
    }

    public function testPostUserMethodYaml()
    {
        $this->post('/user/insert', $this->insertArray, $this->mimeYaml);
    }

    public function testDeleteMethodJson()
    {
        $this->delete('/user/1', $this->mimeJson);
    }

    public function testDeleteMethodYaml()
    {
        $this->delete('/user/1', $this->mimeYaml);
    }
}