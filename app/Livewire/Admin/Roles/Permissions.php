<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Component
{
    public $role;

    public $current_permissions = [];

    public $permissions = [];

    public $saved = false;

    public function rules()
    {
        return [];
    }

    public function mount(Role $role)
    {
        $this->role = $role;

        $records = Permission::orderBy('table')->get();

        foreach($records as $record) {
            if (array_key_exists($record->table, $this->permissions)) {

                $array = $this->permissions[$record->table];

                array_push($array, $record->action);

                $this->permissions[$record->table] = $array;

            } else {
                $this->permissions[$record->table] = [$record->action];
            }
        }

        // $currents = RolePermission::where('role_id', $role->id)->get();
        $currents = $this->role->permissions()->get();

        foreach($currents as $current) {
            if (array_key_exists($current->table, $this->current_permissions)) {

                $array = $this->current_permissions[$current->table];

                array_push($array, $current->action);

                $this->current_permissions[$current->table] = $array;

            } else {
                $this->current_permissions[$current->table] = [$current->action];
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.roles.permissions');
    }

    public function valueInPermissions(string $key, string $value)
    {
        if (array_key_exists($key, $this->current_permissions)) {
            return (in_array($value, $this->current_permissions[$key])) ? 'checked' : '';
        }
        return '';
    }

    public function save()
    {
        $this->saved = false;

        $ids = [];

        foreach($this->current_permissions as $table => $current_permission) {
            foreach($current_permission as $permission) {
                if ($record = Permission::where('table', $table)->where('action', $permission)->first()) {
                    array_push($ids, $record->id);
                }
            }
        }

        //try {
            $this->role->permissions()->sync($ids);
        //} catch (\Exception $th) {}

        $this->saved = true;
    }

    public function togglePermissions(string $key, string $value)
    {
        if (array_key_exists($key, $this->current_permissions)) {
            if (in_array($value, $this->current_permissions[$key])) {
                $this->current_permissions[$key] = array_diff($this->current_permissions[$key], [$value]);
                if (empty($this->current_permissions[$key])) {
                    unset($this->current_permissions[$key]);
                }
            } else {
                $this->current_permissions[$key][] = $value;
            }
        } else {
            $this->current_permissions[$key] = array($value);
        }
    }
}
