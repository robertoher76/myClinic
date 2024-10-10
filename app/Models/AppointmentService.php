<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentService extends Model
{
    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'estimated_minutes' => 0,
        'status'            => 1,
    ];

    /**
     * Get the appointment that owns the appointment service.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Get the service that owns the appointment service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
