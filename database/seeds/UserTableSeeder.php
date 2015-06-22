<?php

use App\User;
use App\Statistics;
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

        $userValues = [
            'firstname' => 'tim',
            'lastname'  => 'joosten',
            'email'     => 'Topairy@gmail.com',
            'password'  => Hash::make('root')
        ];

        $user  = User::create($userValues);
        Statistics::create(['user_id' => $user->id]);

        $user2 = new User;
        $user2->firstname = 'Tidm';
        $user2->lastname  = 'Jodosten';
        $user2->email     = 'Topdairy@gmail.com';
        $user2->save();

    }

}