<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->truncate();

        $user1 = new User;
        $user1->firstname = 'Tim';
        $user1->lastname  = 'Joosten';
        $user1->email     = 'Topairy@gmail.com';
        $user1->password  = Hash::make('root');
        $user1->save();

        $user2 = new User;
        $user2->firstname = 'Tidm';
        $user2->lastname  = 'Jodosten';
        $user2->email     = 'Topdairy@gmail.com';
        $user2->save();

    }

}