<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Requests\UserValidation;

use Symfony\Component\Yaml\Dumper;

use App\Http\Transformers\UserTransformer;
use App\Http\Transformers\InvalidTransformer;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\Cursor;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
     * @param  Request $request
     * @return Response
     */
	public function index(Request $request)
	{
        // Output database columns.
        $columns = ['firstname', 'lastname', 'email'];

        if ($currentCursorStr = Input::get('cursor', false)) {
            $users = User::where('id', '>', $currentCursorStr)->take(5)->get($columns);
        } else {
            $users = User::take(5)->get();
        }

        $prevCursorStr = Input::get('prevCursor', 6);
        $newCursor     = $users->last()->id;
        $cursor        = new Cursor($currentCursorStr, $prevCursorStr, $newCursor, $users->count());

        $resource = new Collection($users, $this->userTransformer->TransformerAll());
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
	public function store(Request $request)
	{
        $MySQL = new User;
        $MySQL->firstname = $request->get('firstname');
        $MySQL->lastname  = $request->get('lastname');
        $MySQL->email     = $request->get('email');

        if($MySQL->save()) {
            switch($request->headers->get('Content-Type')) {
                case "application/json":
                    $responseBody   = $this->userTransformer->insertSuccess();
                    $responseCode   = 200; // HTTP: OK.
                    $responseHeader = 'application/json';
                    break;
                case "text/yaml":
                    $responseBody   = $this->Yaml->dump($this->userTransformer->insertSuccess(), 2);
                    $responseCode   = 200; // HTTP: OK.
                    $responseHeader = 'text/yaml';
                    break;

                default:
                    $responseBody   = $this->invalidTransformer->invalidHttpHead();
                    $responseCode   = 200; // HTTP: OK.
                    $responseHeader = 'application/json';
            }
        } else {
            $responseBody   = "";
            $responseCode   = 400; // HTTP: Bad request.
            $responseHeader = 'application/json';
        }

        $response = response($responseBody, $responseCode);
        $response->header('Content-Type' ,$responseHeader);

        return $response;

	}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param  Request $request
     * @return Response
     */
	public function show($id, Request $request)
	{
        // Output database columns.
        $columns = ['firstname', 'lastname', 'email'];

		$user     = User::where('id', '=', $id)->get($columns);
        $resource = new Collection($user, $this->userTransformer->TransformerSpecific());
        $output   = $this->fractal->createData($resource);

        if (count($user) == 0) {
            $responseBody   = $this->userTransformer->UserNotFound();
            $responseCode   = 200;
            $responseHeader = "application/json";
        } else {

            switch ($request->headers->get('Content-Type')) {
                case "application/json":
                    $responseBody = $output->toJson();
                    $responseCode = 200; // HTTP: OK
                    $responseHeader = 'application/json';
                    break;
                case "text/yaml";
                    $responseBody = $this->Yaml->dump($output->toArray());
                    $responseCode = 200; // HTTP: OK
                    $responseHeader = 'text/yaml';
                    break;
                default:
                    $responseBody = $this->invalidTransformer->invalidHttpHead();
                    $responseCode = 400;
                    $responseHeader = 'application/json';
            }
        }

        $response = response($responseBody, $responseCode);
        $response->header('Content-Type', $responseHeader);

        return $response;
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  UserValidation $input
     * @return Response
     */
	public function update($id, UserValidation $input)
	{
		$MySQL            = User::find($id);
        $MySQL->firstname = $input->firstname;
        $MySQL->lastname  = $input->lastname;
        $MySQL->email     = $input->email;

        if ($MySQL->save()) {
            switch($request->headers->get('Content-Type')) {
                case "text/yaml":
                    $responseCode   = 200;
                    $responseBody   = $this->Yaml->dump($this->userTransformer->UpdateSuccess());
                    $responseHeader = 'text/yaml';
                    break;
                case "application/json":
                    $responseCode   = 200; // HTTP: OK
                    $responseBody   = $this->userTransformer->UpdateSuccess();
                    $responseHeader = 'application/json';
                    break;
                default:
                    $responseCode   = 400;
                    $responseBody   = '';
                    $responseHeader = 'application/json';
            }
        } else {
            $responseCode   = 200; // HTTP: OK
            $responseBody   = $this->userTransformer->errorUpdate();
            $responseHeader = 'application/json';
        }

        $response = response($responseBody, $responseCode);
        $response->header('Content-Type', $responseHeader);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
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
                    $responseCode   = 200; // HTTP: OK
                    $responseHeader = "text/yaml";
                    break;
                default:
                    $responseBody   = $this->invalidTransformer->invalidHttpHead();
                    $responseCode   = 400; // HTTP: Bad request
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
