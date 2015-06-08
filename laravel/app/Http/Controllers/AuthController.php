<?php namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller {

    /**
     * Function for logging in the user.
     *
     * @link   POST /login
     * @return Redirect
     */
	public function verifyLogin()
    {
        $requirements = ['email' => Input::get('email'), 'password' => Input::get('password')];

        if (Auth::attempt($requirements)) {
            $notification['class']   = 'alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.LoginSuccess');

            return redirect::back()->with($notification);
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.LoginError');

            return redirect::back()->with($notification)->withInput();
        }
    }

    public function ViewRegister()
    {
        $data['title'] = Lang::get('auth.titleRegister');
        return view('client.register', $data);
    }

}
