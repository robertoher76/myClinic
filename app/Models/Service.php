<?php

namespace App\Models;

use App\Models\Concerns\Admin\Filters\Field;
use App\Models\Concerns\Admin\Filters\Filter;
use App\Models\Concerns\Admin\Routes\Routes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function filter() : Filter
    {
        return new Filter(
            new Field('none', 'ID', 'id', false),
            new Field('text', 'Nombre', 'name'),
            new Field('number', 'Precio', 'price')
        );
    }

    public function routes() : Routes
    {
        return new Routes(self::class);
    }

    public function rules(?int $id = null): array
    {
        return [
            'name'          => [ 'required', 'string', 'max:255' ],
            'description'   => [ 'required', 'string', 'max:500' ],
            'price'         => [ 'required', 'numeric', 'gt:0' ],
        ];
    }

    /**
     * Get the appointment's services.
     */
    public function services(): HasMany
    {
        return $this->hasMany(AppointmentService::class);
    }
}
