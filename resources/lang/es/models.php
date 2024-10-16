<?php

return [
    //NAME OF MODELS
    'appointments'  => '{1} Cita|[2,*] Citas',
    'doctors'       => '{1} Doctor|[2,*] Doctores',
    'patients'      => '{1} Paciente|[2,*] Pacientes',
    'services'      => '{1} Servicio|[2,*] Servicios',
    'roles'         => '{1} Rol|[2,*] Roles',
    'users'         => '{1} Usuario|[2,*] Usuarios',

    //PROPERTIES OF MODELS
    'appointment'   => [
        'patient_id'    => 'Paciente',
        'scheduled_at'  => 'Fecha y hora',
        'service_id'    => 'Servicio',
        'doctor_id'     => 'Doctor',
    ]
];
