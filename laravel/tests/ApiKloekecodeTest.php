<?php

class ApiKloekecodeTest extends TestCase
{
    public function testGetAll()
    {
        $this->get('/kloekecode/all');
        $this->seeJson();
    }
}