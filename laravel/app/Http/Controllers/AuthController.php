<?php namespace App\Http\Controllers;

use App\User;
use App\Statistics;
use App\Http\Requests;
use App\Http\Requests\UserValidation;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $Variable['firstname'] = $input->firstname;
        $Variable['lastname']  = $input->lastname;
        $Variable['email']     = $input->email;
        $Variable['password']  = str_random(15);

        $userValues = [
            'firstname' => $Variable['firstname'],
            'lastname'  => $Variable['lastname'],
            'email'     => $Variable['email'],
            'password'  => Hash::make($Variable['password'])
        ];

        $user  = User::create($userValues);
        $stats = Statistics::create(['user_id' => $user->id]);

        if ($user && $stats) {
            $notification['class']   = 'alert alert-success';
            $notification['heading'] = Lang::get('alerts.success');
            $notification['message'] = Lang::get('auth.registerSuccess');

            // Email Template
            Mail::send('emails.register', $Variable, function($message) use($Variable) {
                $message->from('Topairy@gmail.com', 'Webred')->subject('register');
                $message->to($Variable['email']);
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
            $notification['class']   = 'alert alert-danger';
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
        $user       = User::destroy($id);
        $statistics = Statistics::destroy($id);

        if ($user > 0 && $statistics > 0) {
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

    /**
     * Make a user back a simple user.
     *
     * @param $id
     * @return mixed
     */
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

    /**
     * Log the user out of the system.
     *
     * @return mixed
     */
    public function Logout()
    {
        Auth::logout();

        $notification['class']   = 'alert alert-success';
        $notification['heading'] = Lang::get('alerts.success');
        $notification['message'] = Lang::get('');

        return Redirect::back()->with($notification);
    }

    /**
     * Account settings view
     *
     * @return \Illuminate\View\View
     */
    public function AccountSettingsView($id)
    {
        $Data['title'] = Lang::get('');
        $Data['query'] = User::where('id', '=', $id)->get();
        return view('Auth.settings', $Data);
    }

    /**
     * Save changes to the database
     *
     * @param UserValidation $input
     * @param $id
     * @return mixed
     */
    public function AccountSettingsUpdate(UserValidation $input, $id)
    {
        $user           = User::find($id);
        $user->email    = $input->email;

        if ($user->save()) {
            $notification['class']   = '';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        } else {
            $notification['class']   = '';
            $notification['heading'] = Lang::get('');
            $notification['message'] = Lang::get('');
        }

        return Redirect::back()->with($notification);
    }

}
