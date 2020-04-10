<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'admin',
               'email'=>'admin@email.com',
                'is_admin'=>'1',
                'cpf' => '123456789',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'user',
               'email'=>'user@email.com',
                'is_admin'=>'0',
                'cpf' => '123654987',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
