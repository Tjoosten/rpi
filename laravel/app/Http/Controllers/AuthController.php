<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Requests\UserValidation;

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

    /**
     * Register view
     *
     * @link   GET /register
     * @return \Illuminate\View\View
     */
    public function ViewRegister()
    {
        $data['title'] = Lang::get('auth.titleRegister');
        return view('client.register', $data);
    }

    /**
     * @param UserValidation $input
     */
    public function postRegister(UserValidation $input)
    {
        $MySQL            = new User;
        $MySQL->firstname = $input->firstname;
        $MySQL->lastname  = $input->lastname;
        $MySQL->email     = $input->email;

        if ($MySQL->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.registerSuccess');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.registerError');
        }

        return Redirect::back()->with($notification);

    }

}
