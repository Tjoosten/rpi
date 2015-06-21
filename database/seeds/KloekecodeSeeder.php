<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Kloekecode;

class KloekecodeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = new Kloekecode;
        $user->Kloekecode = 'Meh';
        $user->save();

    }

}