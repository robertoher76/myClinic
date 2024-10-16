<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Agenda extends Component
{
    public $day;
    public $agenda;

    public $startday;
    public $endday;

    public function mount($day = null)
    {
        Carbon::setLocale('es');

        $this->day = Carbon::today();

        if ($day)
            $this->day = Carbon::parse($day);

        $this->endday = $this->day->clone()->addHours(17);
        $this->startday = $this->day->clone()->addHours(7);

        $this->initializeAgenda();
        $this->initializeAppointments();
    }

    public function render()
    {
        return view('livewire.admin.appointments.agenda');
    }

    protected function initializeAgenda()
    {
        $this->agenda = [];

        $loopday = $this->startday->clone();

        $now = Carbon::now('GMT-6');

        $hour = [];

        while ($loopday < $this->endday)
        {
            $hour = [
                '12HourFormat'      => $loopday->format('g:i A'),
                'hour'              => $loopday->format('H'),
                'date'              => $loopday->toDateString(),
                'available'         => ($loopday < $now) ? false : true,
                'timestamp'         => $loopday->timestamp,
                'appointments'      => []
            ];

            array_push($this->agenda, $hour);

            $loopday->addHour();
        }
    }

    protected function initializeAppointments()
    {
        $appointments = collect();

        $appointments = Appointment::whereDate('scheduled_at', '>=', $this->startday)
            ->whereDate('scheduled_at', '<=', $this->endday)
            ->orderBy('scheduled_at', 'asc')
            ->get()
            ->map(function (Appointment $model)
            {
                $date = Carbon::parse($model->scheduled_at);

                $services = $model->services()->get();

                $array = [];

                $ending = 0;

                foreach($services as $service)
                {
                    $ending += (int) $service->estimated_minutes ?? 0;
                    array_push($array, $service->service->name);
                }

                $end_time = $date->clone()->addMinutes($ending);

                return [
                    'id'            => $model->id,
                    'patient'       => $model->patient->name,
                    'doctor'        => $model->doctor->name,
                    'status'        => $model->status,
                    'status_label'  => $model->status_label,
                    'status_class'  => $model->status_class,
                    'date'          => $date->toDateString(),
                    'start_time'    => $date->format('g:i A'),
                    'end_time'      => $end_time->format('g:i A'),
                    'hour'          => $date->format('H'),
                    'minute'        => $date->format('i'),
                    'grid'          => (int) floor($date->format('i')/15),
                    'timestamp'     => $date->timestamp,
                    'services'      => implode(', ', $array)
                ];
            }) ?? collect();

        if ($appointments->isNotEmpty())
        {
            foreach($appointments as $appointment)
            {
                $key = array_search($appointment['hour'], array_column($this->agenda, 'hour'));
                array_push($this->agenda[$key]['appointments'], $appointment);
            }
        }
    }

    public function previousDay()
    {
        $this->day = $this->day->subDay();

        $this->endday = $this->day->clone()->addHours(17);
        $this->startday = $this->day->clone()->addHours(7);

        $this->initializeAgenda();
        $this->initializeAppointments();
    }

    public function nextDay()
    {
        $this->day = $this->day->addDay();

        $this->endday = $this->day->clone()->addHours(17);
        $this->startday = $this->day->clone()->addHours(7);

        $this->initializeAgenda();
        $this->initializeAppointments();
    }

    #[On('update-agenda')]
    public function updateAgenda()
    {
        $this->initializeAgenda();
        $this->initializeAppointments();
    }

    public function finishAppointment(int $id)
    {
        $cita = Appointment::where('id', '=', $id)->first();

        if ($cita)
        {
            $cita->fill([
                'status' => 2
            ])->save();
        }

        $this->initializeAgenda();
        $this->initializeAppointments();
    }

    public function cancelAppointment(int $id)
    {
        $cita = Appointment::where('id', '=', $id)->first();

        if ($cita)
        {
            $cita->fill([
                'status' => 3
            ])->save();
        }

        $this->initializeAgenda();
        $this->initializeAppointments();
    }

    public function rescheduleAppointment(int $id)
    {
        $cita = Appointment::where('id', '=', $id)->first();

        if ($cita)
        {
            $cita->fill([
                'status' => 4
            ])->save();
        }

        $this->initializeAgenda();
        $this->initializeAppointments();
    }
}
