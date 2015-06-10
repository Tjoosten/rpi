<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'App\Http\Middleware\Authenticate',
        'admin' => 'App\Http\Middleware\Admin',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'csrf' => 'App\Http\Middleware\VerifyCsrfToken',
        'loggedIn' => 'App\Http\Middleware\LoggedIn',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
	];

}
