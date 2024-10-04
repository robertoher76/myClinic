<?php

namespace App\Models;

use App\Models\Concerns\Admin\Filters\Field;
use App\Models\Concerns\Admin\Filters\Filter;
use App\Models\Concerns\Admin\Routes\Routes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function filter() : Filter
    {
        return new Filter(
            new Field('none', 'ID', 'id', false),
            new Field('text', 'Nombre', 'name'),
            new Field('text', 'Cargo', 'cargo')
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
            'cargo'         => [ 'required', 'string', 'max:255' ],
            'phone'         => [ 'required', 'string', 'max:255' ],
        ];
    }
}
