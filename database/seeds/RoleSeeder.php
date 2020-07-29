<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

		foreach (['user' ,'moderador','admin'] as $role){
			\Spatie\Permission\Models\Role::create(['name'=>$role]);
		}
    }
}
