<?php

namespace App\Models;

use App\Models\Concerns\Admin\Filters\Field;
use App\Models\Concerns\Admin\Filters\Filter;
use App\Models\Concerns\Admin\Routes\Routes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $guarded = [];

    public function filter() : Filter
    {
        return new Filter(
            new Field('none', 'ID', 'id', false),
            new Field('text', 'Código', 'code'),
            new Field('text', 'Nombre', 'name')
        );
    }

    public function routes() : Routes
    {
        return new Routes(self::class);
    }

    public function rules(?int $id = null): array
    {
        return [
            'code' => [ 'required', 'string', 'max:255' ],
            'name' => [ 'required', 'string', 'max:255' ],
        ];
    }

    /**
     * The permissions that belong to the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
