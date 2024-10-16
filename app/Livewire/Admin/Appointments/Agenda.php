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

                return [
                    'id'        => $model->id,
                    'patient'   => $model->patient->name,
                    'status'    => $model->status,
                    'date'      => $date->toDateString(),
                    'time'      => $date->format('g:i A'),
                    'hour'      => $date->format('H'),
                    'minute'    => $date->format('i'),
                    'grid'      => (int) floor($date->format('i')/15),
                    'timestamp' => $date->timestamp
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
}
