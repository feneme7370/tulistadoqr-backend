<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userSuperadmin = User::create([
            'name' => 'SuperAdmin',
            'lastname' => 'Master',
            'email' => 'marascofederico95@gmail.com',
            'password' => '$2y$10$BnAoWLTKBHHwp/SAOBzamu/ec8YzDRTHKqLkXRdwCUsCoCJmA/We6',
            'phone' => '2396513953',
            'birthday' => '1995-09-07',
            'adress' => 'Arenales 356',
            'city' => 'Carlos Casares',
            'social' => '',
            'description' => 'Usuario Maestro',
            'status' => '1',
            'company_id' => '1',
        ]);
        $userFalse1 = User::create([
            'name' => 'Roberto',
            'lastname' => 'Martinez',
            'email' => 'prueba@gmail.com',
            'password' => '$2y$10$BnAoWLTKBHHwp/SAOBzamu/ec8YzDRTHKqLkXRdwCUsCoCJmA/We6',
            'phone' => '2395969696',
            'birthday' => '1998-10-05',
            'adress' => 'Zanni 1508',
            'city' => 'Pehuajo',
            'social' => '',
            'description' => 'Usuario de prueba',
            'status' => '1',
            'company_id' => '2',
        ]);
        $userFalse2 = User::create([
            'name' => 'Juan',
            'lastname' => 'Orso',
            'email' => 'prueba2@gmail.com',
            'password' => '$2y$10$BnAoWLTKBHHwp/SAOBzamu/ec8YzDRTHKqLkXRdwCUsCoCJmA/We6',
            'phone' => '2395969696',
            'birthday' => '1998-10-05',
            'adress' => 'Zanni 1508',
            'city' => 'Pehuajo',
            'social' => '',
            'description' => 'Usuario de prueba',
            'status' => '1',
            'company_id' => '3',
        ]);
        $userFalse3 = User::create([
            'name' => 'Franco',
            'lastname' => 'Ibarra',
            'email' => 'prueba3@gmail.com',
            'password' => '$2y$10$BnAoWLTKBHHwp/SAOBzamu/ec8YzDRTHKqLkXRdwCUsCoCJmA/We6',
            'phone' => '2395969696',
            'birthday' => '1998-10-05',
            'adress' => 'Zanni 1508',
            'city' => 'Pehuajo',
            'social' => '',
            'description' => 'Usuario de prueba',
            'status' => '1',
            'company_id' => '4',
        ]);
        
        $adminRole = Role::create(['name' => 'superadmin']);
        $employeeRole = Role::create(['name' => 'employee']);

        $userSuperadmin->assignRole(['superadmin']);
        $userFalse1->assignRole(['employee']);
        $userFalse2->assignRole(['employee']);
        $userFalse3->assignRole(['employee']);
        
        Permission::create(['name' => 'dashboard.index'])->syncRoles([$adminRole, $employeeRole]);
        Permission::create(['name' => 'categories.index'])->syncRoles([$adminRole, $employeeRole]);
        Permission::create(['name' => 'levels.index'])->syncRoles([$adminRole, $employeeRole]);
        
        Permission::create(['name' => 'companies.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'memberships.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'users.index'])->syncRoles([$adminRole]);
    }
}
