<?php

namespace App\Http\Controllers;

use App\Http\Requests\KloekecodeValidation;
use App\Kloekecode;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Transformers\KloekecodeTransformer;

use Illuminate\Support\Facades\Input;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\Cursor;

class ApiKloekecode extends Controller
{
    private $fractal;
    private $kloekecode;

    /**
     * Class constructor
     */
    public function __construct()
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

        $resource = new Collection($kloekecode, $this->kloekecode->KloekecodeTransformer());
        $resource->setCursor($cursor);

        $output = $this->fractal->createData($resource)->toJson();

        return response($output, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KloekecodeValidation $input
     * @return Response
     */
    public function store(KloekecodeValidation $input)
    {
        $Kloekecode = new Kloekecode;
        $Kloekecode->Kloekecode = $input->Kloekecode; 
        $Kloekecode->Plaats     = $input->Plaats;
        $Kloekecode->Gemeente   = $input->Gemeente; 
        $Kloekecode->Provincie  = $input->Provincie;
        
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
        $kloekecode = Kloekecode::where('id', '=', $id)->get();

        $resource   = new Collection($kloekecode, $this->kloekecode->KloekecodeTransformer());
        $output     = $this->fractal->createData($resource)->toJson();

        if (count($kloekecode) > 0) {
            $response['data']      = $output;
            $response['http_code'] = 200; // HTTP: OK.
        } else {
            $response['data']      = $this->kloekecode->EmptyTransformer();
            $response['http_code'] = 200; // HTTP: OK.
        }
        
        return response($response['data'], $response['http_code'])
                ->header('Content-Type', 'application/json'); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KloekecodeValidation $input
     * @param  int $id
     * @return Response
     */
    public function update(KloekecodeValidation $input, $id)
    {
        $Kloekecode = Kloekecode::find($id);
        $Kloekecode->Kloekecode = $input->kloekecode;
        $Kloekecode->Plaats     = $input->plaats;
        $Kloekecode->Gemeente   = $input->gemeente;
        $Kloekecode->Provincie  = $input->provincie;

        if ($Kloekecode->save()) {
            $response['body']      = $this->kloekecode->InsertSuccess();
            $response['http_code'] = 200; // HTTP: OK.
        } else {
            $response['body']      = $this->kloekecode->InsertFailure();
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
            $response['body']      = $this->kloekecode->destroySuccess();
            $response['http_code'] = 200; // HTTP: OK.
        } else {
            $response['body']      = $this->kloekecode->destroyFailure();
            $response['http_code'] = 400; // HTTP: Bad Request
        }

        return response($response['body'], $response['http_code'])
                ->header('Content-Type', 'application/json');
    }
}
