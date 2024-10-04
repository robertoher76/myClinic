<?php

namespace App\Livewire\Admin\Appointments;

use App\Livewire\Admin\Concerns\Calendar;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $edit = false;
    public $saved = false;

    public $id = 0;
    public $patient_id = null;
    public $scheduled_at = null;

    public function render()
    {
        $patients = Patient::all();

        return view('livewire.admin.appointments.form', [
            'patients' => $patients
        ]);
    }

    public function save()
    {
        $this->saved = false;

        if (!$this->edit)
        {
            $this->validate([
                'patient_id'    => [ 'required' ],
                'scheduled_at'  => [ 'required' ],
            ]);

            $appoitnment = Appointment::create([
                'patient_id'    => $this->patient_id,
                'scheduled_at'  => $this->scheduled_at,
                'status'        => 1
            ]);

            $date = Carbon::parse($appoitnment->scheduled_at);

            $array = [
                'id'        => $appoitnment->id,
                'patient'   => $appoitnment->patient->name,
                'status'    => $appoitnment->status,
                'date'      => $date->toDateString(),
                'time'      => $date->format('g:i A'),
                'timestamp' => $date->timestamp
            ];

            $this->reset(['id', 'patient_id', 'scheduled_at']);

            $this->saved = true;

            $this->dispatch('appointment-created', appointment: $array)->to(Calendar::class);
        }
        else
        {
            $this->validate([
                'id'            => [ 'required' ],
                'patient_id'    => [ 'required' ],
                'scheduled_at'  => [ 'required' ],
            ]);

            $appointment = Appointment::where('id', '=', $this->id)->first();

            if ($appointment)
            {
                $appointment->fill([
                    'patient_id'    => $this->patient_id,
                    'scheduled_at'  => $this->scheduled_at
                ])->save();

                $this->reset(['id', 'patient_id', 'scheduled_at']);

                $this->saved = true;

                $this->dispatch('appointment-updated')->to(Calendar::class);
            }
        }
    }

    public function cancel()
    {
        $this->reset(['id', 'patient_id', 'scheduled_at', 'saved', 'edit']);
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
            $this->scheduled_at = $appointment->scheduled_at;
        }
    }
}
