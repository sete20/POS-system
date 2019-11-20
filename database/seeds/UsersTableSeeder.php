<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        $user=\app\User::create([
      
            'first_name'=>'super man',
           'last_name'=>'father of super man',
            'email'=>'super@email.com',
            'password'=>bcrypt(123456789),
        ]);
        $user->attachRole('super_admin');
    }
}
