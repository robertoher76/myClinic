<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $model;

    public function __construct() {
        $this->model = new Role();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index', [
            'model' => $this->model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create', [
            'model' => $this->model
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => [ 'required', 'string', 'max:255' ],
            'name' => [ 'required', 'string', 'max:255' ],
        ]);

        $role = Role::create([
            'code'       => $request->code,
            'name'       => $request->name,
            'modifiable' => true
        ]);

        return redirect()->route('roles.edit', $role)->with('status', 'role-updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('table')->get();

        return view('admin.roles.edit', [
            'model' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = $this->model::findOrFail($id);

        $request->validate([
            'code' => [ 'required', 'string', 'max:255' ],
            'name' => [ 'required', 'string', 'max:255' ],
        ]);

        $item->fill($request->except([]))->save();

        return redirect()->route('roles.edit', $item)->with('status', 'role-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = $this->model::findOrFail($id);

        //if (!$this->model->permissions()->canDelete()) abort(403);

        $item->delete();

        return redirect()->route($this->model->routes()->index());
    }
}
