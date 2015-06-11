<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Requests\UserValidation;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller {

    private $adminMiddleware  = ['deleteUser'];
    private $csrfMiddleware   = ['postRegister'];

    /**
     * Class constructor
     */
    public function __construct()
    {
        //$this->middleware('loggedIn');
        $this->middleware('admin', ['only' => $this->adminMiddleware]);
        $this->middleware('csrf', ['only' => $this->csrfMiddleware]);
    }

    /**
     * get all the users in the system
     *
     * @link   GET /usermanagement
     * @return \Illuminate\View\View
     */
    public function getUsers()
    {
        $data['title'] = Lang::get('auth.titleUsers');
        $data['query'] = user::paginate(15);

        return view('admin.users', $data);
    }

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
     * Insert the newly to the database.
     *
     * @link  POST /register
     * @param UserValidation $input
     */
    public function postRegister(UserValidation $input)
    {
        // Input variable are in a data variable
        // So we can use them into the email template if needed.
        $Data['firstname'] = $input->firstname;
        $Data['lastname']  = $input->lastname;
        $Data['email']     = $input->email;

        $MySQL            = new User;
        $MySQL->firstname = $Data['firstname'];
        $MySQL->lastname  = $Data['lastname'];
        $MySQL->email     = $Data['email'];

        if ($MySQL->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.registerSuccess');

            // Email Template
            Mail::send('emails.register', $Data, function($message) use($Data) {
                $message->from('Topairy@gmail.com', 'Webred')->subject('register');
                $message->to($Data['email']);
            });
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.registerError');
        }

        return Redirect::back()->with($notification);

    }

    /**
     * Block a user.
     *
     * @link   GET /block/{id}
     * @param $id
     * @return mixed
     */
    public function doBlock($id)
    {
        $MySQL         = User::find($id);
        $MySQL->active = "N";

        if ($MySQL->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.blockSuccess');
        } else {
            $notifucation['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.blockError');
        }

        return Redirect::back()->with($notification);
    }

    /**
     * Unblock a user.
     *
     * @link   GET /unblock/{id}
     * @param $id
     * @return mixed
     */
    public function doUnBlock($id)
    {
        $MySQL         = User::find($id);
        $MySQL->active = "Y";

        if ($MySQL->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.unBlockSuccess');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.unBlockError');
        }

        return Redirect::back()->with($notification);
    }

    /**
     * Delete a user out of the system
     *
     * @link   GET /delete/{id}
     * @param $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        $count = User::destroy($id);

        if ($count > 0) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.deleteSuccess');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.deleteError');
        }

        return Redirect::back()->with($notifcation);
    }

    public function doAdmin($id)
    {
        $MySQL       = User::find($id);
        $MySQL->role = "A";

        if ($MySQL->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.adminSuccess');
        } else {
            $notification['class']   = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.adminError');
        }

        return redirect::back()->with($notification);
    }

    public function undoAdmin($id)
    {
        $MySQL       = User::find($id);
        $MySQL->role = "U";

        if ($MySQL->save()) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.undoAdminSuccess');
        } else {
            $notification['class'] = 'alert alert-danger';
            $notification['heading'] = Lang::get('alerts.danger');
            $notification['message'] = Lang::get('auth.undoAdminError');
        }

        return Redirect::back()->with($notification);
    }
}
