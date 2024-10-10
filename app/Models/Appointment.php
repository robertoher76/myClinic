<?php

namespace App\Models;

use App\Models\Concerns\Admin\Routes\Routes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

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
     * Get the appointment's services.
     */
    public function services(): HasMany
    {
        return $this->hasMany(AppointmentService::class);
    }
}
