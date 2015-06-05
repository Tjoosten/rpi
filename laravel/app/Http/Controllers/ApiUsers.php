<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;

use Symfony\Component\Yaml\Dumper;

use App\Http\Transformers\UserTransformer;
use App\Http\Transformers\InvalidTransformer;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\Cursor;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use WebDriver\Exception;

class ApiUsers extends Controller {

    private $fractal;
    private $Yaml;
    private $userTransformer;
    private $invalidTransformer;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->fractal            = new Manager();
        $this->userTransformer    = new UserTransformer;
        $this->invalidTransformer = new InvalidTransformer();
        $this->Yaml               = new Dumper();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
	public function index(Request $request)
	{

        if ($currentCursorStr = Input::get('cursor', false)) {
            $users = User::where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $users = User::take(5)->get();
        }

        $prevCursorStr = Input::get('prevCursor', 6);
        $newCursor     = $users->last()->id;
        $cursor        = new Cursor($currentCursorStr, $prevCursorStr, $newCursor, $users->count());

        $resource = new Collection($users, $this->userTransformer->Transformer());
        $resource->setCursor($cursor);

        $output = $this->fractal->createData($resource);

        switch($request->headers->get('Content-Type')) {
            case "application/json":
                $responseBody   = $output->toJson();
                $responseCode   = 200; // HTTP: OK
                $responseHeader = "application/json";
                break;

            case "text/yaml":
                $responseBody   = $this->Yaml->dump($output->toArray(), 2);
                $responseCode   = 200; // HTTP: OK
                $responseHeader = "text/yaml";
                break;

            default:
                $responseBody   = $this->invalidTransformer->invalidHttpHead();
                $responseCode   = 400; // HTTP: Bad Request
                $responseHeader = "application/json";
        }

        $response = response($responseBody, $responseCode);
        $response->header('Content-Type', $responseHeader);

		return $response;
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
		//
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
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
		//
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Response
     */
	public function destroy($id, Request $request)
	{
        $count = User::destroy($id);


        if($count > 0) {
            switch($request->headers->get('Content-Type')) {
                case "application/json":
                    $responseBody   = $this->userTransformer->DeleteSuccess();
                    $responseCode   = 200;
                    $responseHeader = 'application/json';
                    break;
                case "text/yaml":
                    $responseBody   = $this->Yaml->dump($this->userTransformer->DeleteSuccess(), 2);
                    $responseCode   = 200;
                    $responseHeader = "text/yaml";
                    break;
                default:
                    $responseBody   = $this->invalidTransformer->invalidHttpHead();
                    $responseCode   = 400;
                    $responseHeader = "application/json";
            }
        } else {
            $responseBody   = $this->userTransformer->DeleteError();
            $responseCode   = 200;
            $responseHeader = "application/json";
        }

        $response = new response($responseBody, $responseCode);
        $response->header('Content-Type', $responseHeader);

        return $response;
	}

}
