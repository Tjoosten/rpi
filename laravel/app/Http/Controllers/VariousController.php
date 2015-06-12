<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class VariousController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
     * @todo not ready
	 * @return Response
	 */
	public function index()
	{
        $data['title'] = 'Index';
		return view('client.frontpage', $data);
	}

    /**
     * Get the view for the mail function.
     *
     * @todo not ready
     */
    public function mailView()
    {
        $data['title'] = Lang::get();
        return view('', $data);
    }

    /**
     * Send a mail.
     *
     * @todo not ready
     */
    public function sendMail()
    {

    }

}
