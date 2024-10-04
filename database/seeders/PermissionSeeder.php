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
                'code'      => 'users.create',
                'name'      => 'Agregar Usuarios',
                'table'     => 'users',
                'action'    => 'create',
            ],
            [
                'code'      => 'users.read',
                'name'      => 'Leer Usuarios',
                'table'     => 'users',
                'action'    => 'read',
            ],
            [
                'code'      => 'users.update',
                'name'      => 'Editar Usuarios',
                'table'     => 'users',
                'action'    => 'update',
            ],
            [
                'code'      => 'users.delete',
                'name'      => 'Eliminar Usuarios',
                'table'     => 'users',
                'action'    => 'delete',
            ],
            //SERVICIOS
            [
                'code'      => 'services.create',
                'name'      => 'Agregar Servicios',
                'table'     => 'services',
                'action'    => 'create',
            ],
            [
                'code'      => 'services.read',
                'name'      => 'Leer Servicios',
                'table'     => 'services',
                'action'    => 'read',
            ],
            [
                'code'      => 'services.update',
                'name'      => 'Editar Servicios',
                'table'     => 'services',
                'action'    => 'update',
            ],
            [
                'code'      => 'services.delete',
                'name'      => 'Eliminar Servicios',
                'table'     => 'services',
                'action'    => 'delete',
            ]

        ];

        foreach($permissions as $permission)
        {
            $record = Permission::create([
                'code'          => $permission['code'],
                'name'          => $permission['name'],
                'table'         => $permission['table'],
                'action'        => $permission['action']
            ]);

            $role->permissions()->attach($record->id);
        }
    }
}
