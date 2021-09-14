<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
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


    }
}
