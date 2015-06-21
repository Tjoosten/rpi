<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ContactValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

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
     * @todo clean up error messages & success notification if send mail.
     * @todo set translation data.
     */
    public function mailView()
    {
        $data['title'] = Lang::get('');
        return view('client.email', $data);
    }

    /**
     * Send a mail.
     *
     * @todo not ready
     * @todo set translation data
     * @param ContactValidation $input
     */
    public function sendMail(ContactValidation $input)
    {
        $Data['email']   = $input->email;
        $Data['title']   = $input->subject;
        $Data['msg']     = $input->message;

        // Email Template
        Mail::send('emails.contact', $Data, function($message) use($Data) {
            $message->from($Data['email'], 'Contact dialect database')->subject($Data['title']);
            $message->to('Topairy@gmail.com');
        });

        if (Mail::failures() >= 0) {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        }

        return Redirect::back()->with($notification);
    }

}
