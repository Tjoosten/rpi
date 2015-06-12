<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Transformers\KloekecodeTransformer;

use Illuminate\Support\Facades\Input;

use League\Fractal\Manager;
use League\Fractal\Pagination\Cursor;

class ApiKloekecode extends Controller
{
    private $fractal;
    private $kloekecode;

    /**
     * Class constructor
     */
    public function __constrct()
    {
        $this->fractal    = new Manager();
        $this->kloekecode = new KloekecodeTransformer();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Output database columns.
        $columns = ['kloekecode'];

        if ($currentCursorStr = Input::get('cursor', false)) {
            $kloekecode = Kloekecode::where('id', '>', $currentCursorStr)->take(5)->get($columns);
        } else {
            $kloekecode = Kloekecode::take(5)->get();
        }

        $prevCursorStr = Input::get('prevCursor', 6);
        $newCursor     = $kloekecode->last()->id;
        $cursor        = new Cursor($currentCursorStr, $prevCursorStr, $newCursor, $kloekecode->count());

        $resource = new Collection($kloekecode, $this->kloekecode->Transformer());
        $resource->setCursor($cursor);

        $output = $this->fractal->createData($resource)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $Kloekecode = new Kloekecode;

        if ($Kloekecode->save()) {
            $response['content'] = $this->kloekecode->KloekecodeTransformer();
            $response['port']    = 200; // HTTP: OK.
        } else {
            $response['content'] = $this->kloekecode->EmptyTransformer();
            $response['port']    = 400; // HTTP: Bad Request.
        }

        return response($response['content'], $response['port'])
                ->header('Content-Type', 'application/josn');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $Kloekecode = Kloekecode::find($id);
        $Kloekecode->Kloekecode = $input->kloekecode;
        $Kloekecode->Plaats     = $input->plaats;
        $Kloekecode->Gemeente   = $input->gemeente;
        $Kloekecode->Provincie  = $input->provincie;

        if ($Kloekecode->save()) {
            $response['body']      = $this->kloekecode->KloekecodeTransformer();
            $response['http_code'] = 200; // HTTP: OK.
        } else {
            $response['body']      = $this->kloekecode->EmptyTransformer();
            $response['http_code'] = 200; // HTTP: OK.
        }

        return response($response['body'], $response['http_code'])
                ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $count = Kloekecode::destroy($id);

        if ($count > 0) {
            $response['body']      = '';
            $response['http_code'] = 200; // HTTP: OK.
        } else {
            $response['body']      = '';
            $response['http_code'] = 400; // HTTP: Bad Request
        }

        return response($response['body'], $response['http_code'])
                ->header('Content-Type', 'application/json')
    }
}
