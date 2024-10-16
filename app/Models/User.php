<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Concerns\Admin\Filters\Field;
use App\Models\Concerns\Admin\Filters\Filter;
use App\Models\Concerns\Admin\Routes\Routes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function filter() : Filter
    {
        return new Filter(
            new Field('none', 'ID', 'id', false),
            new Field('text', 'Nombre', 'name'),
            new Field('text', 'Email', 'email')
        );
    }

    public function routes() : Routes
    {
        return new Routes(self::class);
    }

    public function rules(?int $id = null): array
    {
        return [
            'name'  => [ 'required', 'string', 'max:255' ],
            'email' => [ 'required', 'string', 'max:255' ],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
