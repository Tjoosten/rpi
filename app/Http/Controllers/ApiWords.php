<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\Cursor;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Transformers\wordTransformer;

class ApiWords extends Controller
{
    private $fractal;
    private $wordTransformer;

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->fractal = new Manager();
        $this->wordTransformer = new wordTransformer(); 
    }

    /**
     * @api {get} /api/words/all Alle woorden.
     * @apiName GetWords
     * @apiGroup Words
     */
    public function index()
    {

    }

    /**
     * @api {post} /api/words/insert Woord toevoegen.
     * @apiName PostWords
     * @apiGroup Words
     * @apiVersion 1.0.0
     * @apiPermission Logged In
     *
     * @apiHeader (Content-Type) {json} application/json Header voor een JSON output.
     *
     * @apiParam {integer} [region_id]      De ID van het woord.
     * @apiParam {string}  [word_an]        Het algemeen nederlands woord.
     * @apiParam {string}  [word_fonetic]   Het fonetische woord.
     * @apiParam {string}  [dialect]        Het woord in zijn dialect?
     * @apiParam {string}  [description]    De beschrijving van het woord.
     */
    public function store()
    {
        //
    }

    /**
     * @api {get} /api/words/{id} Specifiek woord
     * @apiname GetWord
     * @apiGroup Words
     * @apiVersion 1.0.0
     *
     * @apiHeader (Content-Type) {json} application/json Header voor een JSON output.
     */
    public function show($id)
    {
        $words    = Words::where('id', '=', $id)->get();
        $resource = new Collection($user, $this->wordTransformer->TransformerSpecific());
        $output   = $this->fractal->createData($resource);
        
        if ($output > 0) {
            $responseBody   = $output->toJson();  
        } else {
            $responseBody   = $this->wordTransformer->EmptyTransformer(); 
        }
        
        $response = response($responseBody, 200)->header('application/json');
        return $response;
    }

    /**
     * @api {put} /api/words/{id} Update een woord.
     * @apiName UpdateWord
     * @apiGroup Words
     * @apiversion 1.0.0
     *
     * @apiDescription Deze route kan ook aangeroepen worden door een PATCH methode.
     *
     * @apiParam {integer} [region_id]      De ID van het woord.
     * @apiParam {string}  [word_an]        Het algemeen nederlands woord.
     * @apiParam {string}  [word_fonetic]   Het fonetische woord.
     * @apiParam {string}  [dialect]        Het woord in zijn dialect?
     * @apiParam {string}  [description]    De beschrijving van het woord.
     */
    public function update($id)
    {
        //
    }

    /**
     * @api {delete} /api/words/{id} Woord verwijderen.
     * @apiName DeleteWords
     * @apigroup Words
     * @apiVersion 1.0.0
     * @apiPermission Logged In, Administrator
     *
     * @apiHeader (Content-Type) {json} application/json Header voor een JSON output.
     * @apiParam {integer} id De ID van het woord.
     */
    public function destroy(Request $request, $id)
    {
        $destroy = Words::destroy($id); 
        
        if ($destroy > 0) {
            $responseBody = $this->wordTransformer->SuccessDelete();
        } else {
            $responseBody = $this->wordTransformer->ErrorDelete(); 
        } 
        
        $response = response($responseBody, 200)->header("application/json"); 
        return $response;
        
    }
}
