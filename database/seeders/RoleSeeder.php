<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleSecretaria = Role::create(['name' => 'Secretaria']);
        
        
        $permissions = [
           
            'clientes.index', 'clientes.create', 'clientes.store', 'clientes.edit', 'clientes.update', 'clientes.destroy',

            
            'sucursales.index', 'sucursales.create', 'sucursales.store', 'sucursales.edit', 'sucursales.update', 'sucursales.destroy',

            
            'choferes.index', 'choferes.create', 'choferes.store', 'choferes.edit', 'choferes.update', 'choferes.destroy',

      
            'autos.index', 'autos.create', 'autos.store', 'autos.edit', 'autos.update', 'autos.destroy',

         
            'encomiendas.index', 'encomiendas.create', 'encomiendas.store', 'encomiendas.show', 'encomiendas.edit', 'encomiendas.update', 'encomiendas.destroy', 
            'encomiendas.print', 'encomiendas.pdf', 'encomiendas.deliver'
        ];

        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

   
        $roleAdmin->givePermissionTo(Permission::all());

       
        $roleSecretaria->givePermissionTo([
            'clientes.index', 'clientes.create', 'clientes.store', 'clientes.edit', 'clientes.update',
            'choferes.index', 'choferes.create', 'choferes.store', 'choferes.edit', 'choferes.update',
            'autos.index', 'autos.create', 'autos.store', 'autos.edit', 'autos.update',
            'encomiendas.index', 'encomiendas.create', 'encomiendas.store', 'encomiendas.show', 'encomiendas.edit', 'encomiendas.update'
           
        ]);
    }
}
