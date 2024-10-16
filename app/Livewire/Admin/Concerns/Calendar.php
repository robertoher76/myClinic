<?php

namespace App\Livewire\Admin\Concerns;

use App\Livewire\Admin\Appointments\Form;
use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Calendar extends Component
{
    public $date;
    public $calendar;

    public $startdate;
    public $enddate;

    public function mount($date = null)
    {
        Carbon::setLocale('es');

        $this->date = Carbon::today();

        if ($date)
            $this->date = Carbon::parse($date);

        $this->enddate = $this->date->clone()->endOfMonth()->endOfWeek()->subDay();
        $this->startdate = $this->date->clone()->startOfMonth()->startOfWeek()->subDay();

        $this->initializeCalendar();
        $this->initializeAppointments();
    }

    public function render()
    {
        return view('livewire.admin.layouts.calendar');
    }

    public function previousMonth()
    {
        $this->date = $this->date->subMonth();

        $this->enddate = $this->date->clone()->endOfMonth()->endOfWeek()->subDay();
        $this->startdate = $this->date->clone()->startOfMonth()->startOfWeek()->subDay();

        $this->initializeCalendar();
        $this->initializeAppointments();
    }

    public function nextMonth()
    {
        $this->date = $this->date->addMonth();

        $this->enddate = $this->date->clone()->endOfMonth()->endOfWeek()->subDay();
        $this->startdate = $this->date->clone()->startOfMonth()->startOfWeek()->subDay();

        $this->initializeCalendar();
        $this->initializeAppointments();
    }

    protected function initializeCalendar()
    {
        $this->calendar = [];

        $loopdate = $this->startdate->clone();
        $month = $this->date->clone();

        $day = [];

        while ($loopdate < $this->enddate)
        {
            $day = [
                'day'               => $loopdate->format('j'),
                'date'              => $loopdate->toDateString(),
                'available'         => ($loopdate < $this->date) ? false : true,
                'timestamp'         => $loopdate->timestamp,
                'is_today'          => ($loopdate == $this->date) ? true : false,
                'is_current_month'  => ($loopdate < $month->startOfMonth() || $loopdate > $month->endOfMonth()) ? false : true,
                'appointments'      => []
            ];

            array_push($this->calendar, $day);

            $loopdate->addDay();
        }
    }

    protected function initializeAppointments()
    {
        $appointments = collect();

        $appointments = Appointment::whereDate('scheduled_at', '>=', $this->startdate)
            ->whereDate('scheduled_at', '<=', $this->enddate)
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
                    'timestamp' => $date->timestamp
                ];
            }) ?? collect();

        if ($appointments->isNotEmpty())
        {
            foreach($appointments as $appointment)
            {
                $key = array_search($appointment['date'], array_column($this->calendar, 'date'));
                array_push($this->calendar[$key]['appointments'], $appointment);
            }
        }
    }

    #[On('appointment-created')]
    public function updateCalendarByAppointmentCreated()
    {
        $this->initializeCalendar();
        $this->initializeAppointments();
    }

    #[On('appointment-updated')]
    public function updateCalendarByAppointmentUpdated()
    {
        $this->initializeCalendar();
        $this->initializeAppointments();
    }

    public function newAppointmentByDate(int $timestamp)
    {
        $this->dispatch('appointment-new', timestamp: $timestamp)->to(Form::class);
    }

    public function editAppointment(int $id)
    {
        $this->dispatch('appointment-edit', id: $id)->to(Form::class);
    }
}
