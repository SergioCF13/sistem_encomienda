<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        
       
        $roleSecretaria = Role::firstOrCreate(['name' => 'Secretaria']);

       
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', 
            'password' => Hash::make('12345678'), 
        ]);

        
        $adminUser->assignRole($roleAdmin);

        
        auth()->login($adminUser);

        
        $secretariaUser = User::create([
            'name' => 'Secretaria User',
            'email' => 'secretaria@example.com', 
            'password' => Hash::make('12345678'), 
        ]);

        
        $secretariaUser->assignRole($roleSecretaria);
    }
}
