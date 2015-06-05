<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = new User;
        $user->firstname = 'Tim';
        $user->lastname  = 'Joosten';
        $user->email     = 'Topairy@gmail.com';
        $user->save();

        $user = new User;
        $user->firstname = 'Tidm';
        $user->lastname  = 'Jodosten';
        $user->email     = 'Topdairy@gmail.com';
        $user->save();

    }

}