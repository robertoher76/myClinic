<?php

namespace App\Livewire\Admin\Appointments;

use App\Livewire\Admin\Concerns\Calendar;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $show = false;

    public $edit = false;
    public $saved = false;

    public $id = 0;
    public $doctor_id = null;
    public $patient_id = null;
    public $scheduled_at = null;

    public $service_id = null;
    public $appointment_services;

    public function mount()
    {
        $this->appointment_services = collect();
    }

    public function render()
    {
        $patients = Patient::all();

        $doctors = Doctor::all();

        $services = Service::all();

        return view('livewire.admin.appointments.form', [
            'doctors'   => $doctors,
            'patients'  => $patients,
            'services'  => $services
        ]);
    }

    public function save()
    {
        $this->saved = false;

        if (!$this->edit)
        {
            $this->validate([
                'doctor_id'     => [ 'required' ],
                'patient_id'    => [ 'required' ],
                'scheduled_at'  => [ 'required' ],
            ]);

            if ($this->appointment_services->isEmpty())
            {
                $this->service_id = null;
                $this->validate([
                    'service_id' => [ 'required' ],
                ]);
            }

            $appointment = Appointment::create([
                'doctor_id'     => $this->doctor_id,
                'patient_id'    => $this->patient_id,
                'scheduled_at'  => $this->scheduled_at,
                'status'        => 1
            ]);

            $array = $this->appointment_services->select(['service_id', 'status', 'estimated_minutes'])->toArray();
            $appointment->services()->createMany($array);

            $this->reset(['id', 'patient_id', 'service_id', 'doctor_id', 'scheduled_at', 'edit']);

            $this->appointment_services = collect();

            $this->saved = true;

            $this->dispatch('appointment-created')->to(Calendar::class);
            $this->dispatch('update-agenda')->to(Agenda::class);
        }
        else
        {
            $this->validate([
                'id'            => [ 'required' ],
                'doctor_id'     => [ 'required' ],
                'patient_id'    => [ 'required' ],
                'scheduled_at'  => [ 'required' ],
            ]);

            $appointment = Appointment::where('id', '=', $this->id)->first();

            if ($appointment)
            {
                $appointment->fill([
                    'doctor_id'     => $this->doctor_id,
                    'patient_id'    => $this->patient_id,
                    'scheduled_at'  => $this->scheduled_at,
                    'status'        => 1
                ])->save();

                $appointment->services()->delete();

                if ($this->appointment_services->isNotEmpty())
                {
                    $array = $this->appointment_services->select(['service_id', 'status', 'estimated_minutes'])->toArray();
                    $appointment->services()->createMany($array);
                }

                $this->reset(['id', 'patient_id', 'service_id', 'doctor_id', 'scheduled_at', 'edit']);

                $this->appointment_services = collect();

                $this->saved = true;

                $this->dispatch('appointment-updated')->to(Calendar::class);
                $this->dispatch('update-agenda')->to(Agenda::class);
            }
        }
    }

    public function cancel()
    {
        $this->reset(['id', 'patient_id', 'service_id', 'doctor_id', 'scheduled_at', 'saved', 'edit']);

        $this->appointment_services = collect();

        $this->show = false;
    }

    #[On('appointment-new')]
    public function newAppointment(?int $timestamp = null)
    {
        if ($timestamp) {
            $this->scheduled_at = date('Y-m-d\TH:i', $timestamp);
        }
        $this->show = true;
    }

    #[On('appointment-edit')]
    public function editAppointmentById(int $id)
    {
        $appointment = Appointment::where('id', '=', $id)->first();

        if ($appointment)
        {
            $this->edit = true;
            $this->id = $appointment->id;
            $this->patient_id = $appointment->patient_id;
            $this->doctor_id = $appointment->doctor_id;
            $this->scheduled_at = $appointment->scheduled_at;
            $this->appointment_services = collect();

            if ($appointment->services()->exists())
            {
                $this->appointment_services = $appointment->services()->get()->map(function (AppointmentService $item) {
                    return [
                        'service_id'        => $item->service_id,
                        'name'              => $item->service->name,
                        'status'            => $item->status,
                        'estimated_minutes' => $item->estimated_minutes
                    ];
                });
            }
        }

        $this->show = true;
    }

    public function addServiceToAppointment()
    {
        $this->validate([
            'service_id' => [ 'required' ],
        ]);

        $model = Service::where('id', $this->service_id)->select(['id', 'name'])->first();

        if ($model)
        {
            if (!$this->appointment_services->firstWhere('service_id', $model->id))
            {
                $service = [
                    'service_id'        => $model->id,
                    'name'              => $model->name,
                    'status'            => 1,
                    'estimated_minutes' => 30
                ];

                $this->appointment_services->push($service);
            }
        }
    }

    public function deleteServiceToAppointment(int $service_id)
    {
        if ($this->appointment_services->firstWhere('service_id', $service_id))
        {
            $this->appointment_services = $this->appointment_services->reject(function (array $value) use ($service_id) {
                return $value['service_id'] == $service_id;
            });
        }
    }
}
