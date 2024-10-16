<?php

namespace App\Models;

use App\Models\Concerns\Admin\Routes\Routes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    private const STATUS_ARRAY = [
        0 => '',
        1 => 'Programado',
        2 => 'Finalizado',
        3 => 'Cancelado',
        4 => 'Reprogramado'
    ];

    private const STATUS_CLASS_ARRAY = [
        0 => '',
        1 => 'appointment-scheduled',
        2 => 'appointment-finalized',
        3 => 'appointment-canceled',
        4 => 'appointment-rescheduled'
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_ARRAY[$this->status] ?? '';
    }

    public function getStatusClassAttribute(): string
    {
        return self::STATUS_CLASS_ARRAY[$this->status] ?? '';
    }

    public function getAppointmentStartTimeAttribute(): ?string
    {
        $date = Carbon::parse($this->scheduled_at);

        return $date->format('g:i A') ?? '';
    }

    public function getAppointmentEndTimeAttribute(): ?string
    {
        $date = Carbon::parse($this->scheduled_at);

        return $date->format('g:i A') ?? '';
    }

    public function getStartAndEndTimeAppointmentAttribute(): ?string
    {
        $date = Carbon::parse($this->scheduled_at);

        $services = $this->services()->get();

        // $

        // foreach($services as $service)
        // {

        // }

        return $date->format('g:i A') ?? '';
    }

    public function routes() : Routes
    {
        return new Routes(self::class);
    }

    /**
     * Get the patient that owns the appointment.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor that owns the appointment.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the appointment's services.
     */
    public function services(): HasMany
    {
        return $this->hasMany(AppointmentService::class);
    }
}
