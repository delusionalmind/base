<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $x = new User();
        $x->name = 'andie';
        $x->email = 'andie@stud.io';
        $x->type = 'Admin';
        $x->status = '1';
        $x->password = bcrypt('qwerty12');

        $x->save();

        $y = new User();
        $y->name = 'test';
        $y->email = 'test@test';
        $y->type = 'User';
        $y->status = '0';
        $y->password = bcrypt('qwerty12');

        $y->save();
    }
}
