<?php

use Illuminate\Support\Facades\Artisan;
use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

class TestCase extends IntegrationTest {

    public function setUp()
    {
        parent::setUp();
        putenv('DB_DEFAULT_CONNECTION=sqlite');
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
        putenv('DB_DEFAULT_CONNECTION=sqlite');

		$app = require __DIR__.'/../bootstrap/app.php';
		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

}
