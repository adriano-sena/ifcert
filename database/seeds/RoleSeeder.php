<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		// Reset cached roles and permissions
		app()[PermissionRegistrar::class]->forgetCachedPermissions();

    	$permissions = [
    		'criar-evento',
			'visualizar-evento',
			'deletar-evento',
			'editar-evento',
			'criar-atividade',
			'deletar-atividade',
			'editar-atividade',
			'visualizar-atividade'
		];

    	//Persistindo as permissoes no database
    	foreach ($permissions as $permission){
			Permission::create(['name' => $permission]);
		}

    	//Persistindo os roles
		/*foreach (['user','moderador','admin'] as $role){
			\Spatie\Permission\Models\Role::create(['name'=>$role]);
		}*/

		//Atribuindo as permissões para cada Role
		$adminRole = Role::create(['name' => 'super-admin']);
		$userRole = Role::create(['name' => 'user']);
		$userRole->givePermissionTo(['visualizar-evento', 'visualizar-atividade']);

		$moderadorRole = Role::create(['name' => 'moderador']);
		$moderadorRole->givePermissionTo(['editar-evento' , 'editar-atividade',
			'visualizar-evento', 'visualizar-atividade']);



    }
}
