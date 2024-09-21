<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ROL
        $role = Role::create([
            'code'          => 'sysadmin',
            'name'          => 'Administrador',
            'modifiable'    => false
        ]);

        //PERMISSIONS
        $permissions = [
            //USERS
            [
                'code' => 'users.create',
                'name' => 'Agregar Usuarios'
            ],
            [
                'code' => 'users.read',
                'name' => 'Leer Usuarios'
            ],
            [
                'code' => 'users.update',
                'name' => 'Editar Usuarios'
            ],
            [
                'code' => 'users.delete',
                'name' => 'Eliminar Usuarios'
            ],
            //SERVICIOS
            [
                'code' => 'services.create',
                'name' => 'Agregar Servicios'
            ],
            [
                'code' => 'services.read',
                'name' => 'Leer Servicios'
            ],
            [
                'code' => 'services.update',
                'name' => 'Editar Servicios'
            ],
            [
                'code' => 'services.delete',
                'name' => 'Eliminar Servicios'
            ]

        ];

        foreach($permissions as $permission)
        {
            $record = Permission::create([
                'code'          => $permission['code'],
                'name'          => $permission['name']
            ]);

            $role->permissions()->attach($record->id);
        }
    }
}
