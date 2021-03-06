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
                'cpf' => '123456789',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'user',
               'email'=>'user@email.com',
                'cpf' => '123654987',
               'password'=> bcrypt('123456'),
            ],
        ];

		User::create( [
			'name'=>'admin',
			'email'=>'admin@email.com',
			'cpf' => '123456789',
			'password'=> bcrypt('12345678'),
		])->roles()->attach(\Spatie\Permission\Models\Role::where('name','admin')->first()->id);

		User::create( [
			'name'=>'user',
			'email'=>'user@email.com',
			'cpf' => '123456780',
			'password'=> bcrypt('12345678'),
		])->roles()->attach(\Spatie\Permission\Models\Role::where('name','user')->first()->id);


	}
}
