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
        // $role = Role::create([
        //     'code'          => 'sysadmin',
        //     'name'          => 'Administrador',
        //     'modifiable'    => false
        // ]);
        $role = Role::first();

        //PERMISSIONS
        $permissions = [
            // //USERS
            // [
            //     'code'      => 'users.create',
            //     'name'      => 'Agregar Usuarios',
            //     'table'     => 'users',
            //     'action'    => 'create',
            // ],
            // [
            //     'code'      => 'users.read',
            //     'name'      => 'Leer Usuarios',
            //     'table'     => 'users',
            //     'action'    => 'read',
            // ],
            // [
            //     'code'      => 'users.update',
            //     'name'      => 'Editar Usuarios',
            //     'table'     => 'users',
            //     'action'    => 'update',
            // ],
            // [
            //     'code'      => 'users.delete',
            //     'name'      => 'Eliminar Usuarios',
            //     'table'     => 'users',
            //     'action'    => 'delete',
            // ],
            // //SERVICIOS
            // [
            //     'code'      => 'services.create',
            //     'name'      => 'Agregar Servicios',
            //     'table'     => 'services',
            //     'action'    => 'create',
            // ],
            // [
            //     'code'      => 'services.read',
            //     'name'      => 'Leer Servicios',
            //     'table'     => 'services',
            //     'action'    => 'read',
            // ],
            // [
            //     'code'      => 'services.update',
            //     'name'      => 'Editar Servicios',
            //     'table'     => 'services',
            //     'action'    => 'update',
            // ],
            // [
            //     'code'      => 'services.delete',
            //     'name'      => 'Eliminar Servicios',
            //     'table'     => 'services',
            //     'action'    => 'delete',
            // ],
            //DOCTORES
            [
                'code'      => 'doctors.create',
                'name'      => 'Agregar Doctores',
                'table'     => 'doctors',
                'action'    => 'create',
            ],
            [
                'code'      => 'doctors.read',
                'name'      => 'Leer Doctores',
                'table'     => 'doctors',
                'action'    => 'read',
            ],
            [
                'code'      => 'doctors.update',
                'name'      => 'Editar Doctores',
                'table'     => 'doctors',
                'action'    => 'update',
            ],
            [
                'code'      => 'doctors.delete',
                'name'      => 'Eliminar Doctores',
                'table'     => 'doctors',
                'action'    => 'delete',
            ],
            //Pacientes
            [
                'code'      => 'patients.create',
                'name'      => 'Agregar Paciente',
                'table'     => 'patients',
                'action'    => 'create',
            ],
            [
                'code'      => 'patients.read',
                'name'      => 'Leer Paciente',
                'table'     => 'patients',
                'action'    => 'read',
            ],
            [
                'code'      => 'patients.update',
                'name'      => 'Editar Paciente',
                'table'     => 'patients',
                'action'    => 'update',
            ],
            [
                'code'      => 'patients.delete',
                'name'      => 'Eliminar Paciente',
                'table'     => 'patients',
                'action'    => 'delete',
            ],
            //Citas
            [
                'code'      => 'appointments.create',
                'name'      => 'Agregar Citas',
                'table'     => 'appointments',
                'action'    => 'create',
            ],
            [
                'code'      => 'appointments.read',
                'name'      => 'Leer Citas',
                'table'     => 'appointments',
                'action'    => 'read',
            ],
            [
                'code'      => 'appointments.update',
                'name'      => 'Editar Citas',
                'table'     => 'appointments',
                'action'    => 'update',
            ],
            [
                'code'      => 'appointments.delete',
                'name'      => 'Eliminar Citas',
                'table'     => 'appointments',
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
