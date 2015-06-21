<?php

class ApiKloekecodeTest extends TestCase
{
    public function testGetAll()
    {
        $response = $this->call('GET', '/kloekecode/all');
        $this->seeJson();

        $array = json_decode($response->getContent(), true);
        $this->assertTrue(sizeof($array) > 0);

        $dataArray = $array['data'][0];
        $metaArray = $array['meta']['cursor'];

        $this->assertArrayHasKey('Kloekecode', $dataArray);
        $this->assertArrayHasKey('Plaats', $dataArray);
        $this->assertArrayHasKey('Gemeente', $dataArray);
        $this->assertArrayHasKey('Provincie', $dataArray);

        $this->assertArrayHasKey('current', $metaArray);
        $this->assertArrayHasKey('prev', $metaArray);
        $this->assertArrayHasKey('next', $metaArray);
        $this->assertArrayHasKey('count', $metaArray);
    }

    public function testGetSpecific()
    {
        $response = $this->call('GET', '/kloekecode/1');
        $this->seeJson();

        $array = json_decode($response->getContent(), true);
        $this->assertTrue(sizeof($array) > 0);

        $dataArray = $array['data'][0];

        $this->assertArrayHasKey('Kloekecode', $dataArray);
        $this->assertArrayHasKey('Plaats', $dataArray);
        $this->assertArrayHasKey('Gemeente', $dataArray);
        $this->assertArrayHasKey('Provincie', $dataArray);
    }

    public function testPostInsertKloekecode()
    {
        $insertArray = [
            'Gemeente'   => 'meh',
            'Kloekecode' => 'foo',
            'Plaats'     => 'bar',
            'Provincie'  => 'baz'
        ];

        $this->post('/kloekecode/insert', $insertArray);
    }

    public function testDeleteKloekecode()
    {
        $this->delete('/kloekecode/1');
        $this->assertResponseOk();
    }

    public function testPatchKloekecode()
    {
        $insertArray = [
            'Gemeente'   => 'meh',
            'Kloekecode' => 'foo',
            'Plaats'     => 'bar',
            'Provincie'  => 'baz'
        ];

        $this->patch('/kloekecode/1', $insertArray);
    }

    public function testPutKloekecode()
    {
        $insertArray = [
            'Gemeente'   => 'meh',
            'Kloekecode' => 'foo',
            'Plaats'     => 'bar',
            'Provincie'  => 'baz'
        ];

        $this->put('/kloekecode/1', $insertArray);
    }

}