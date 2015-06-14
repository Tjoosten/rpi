<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ContactValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

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
        return view('client.email', $data);
    }

    /**
     * Send a mail.
     *
     * @todo not ready
     * @param ContactValidation $input
     */
    public function sendMail(ContactValidation $input)
    {
        $Data['email']   = $input->email;
        $Data['title']   = $input->title;
        $Data['message'] = $input->message;

        // Email Template
        Mail::send('emails.contact', $Data, function($message) use($Data) {
            $message->from($Data['email'], 'Contact dialect database')->subject('Contact');
            $message->to('Topairy@gmail.com');
        });
    }

}
