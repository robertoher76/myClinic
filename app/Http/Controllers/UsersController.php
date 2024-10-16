<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $model;

    public function __construct() {
        $this->model = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', [
            'model' => $this->model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', [
            'model'     => $this->model,
            'roles'     => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role_id'   => ['required'],
            'password'  => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role_id'   => $request->role_id,
            'password'  => Hash::make($request->password),
        ]);

        return redirect()->route('users.edit', $user)->with('status', 'user-updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', [
            'model' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = $this->model::findOrFail($id);

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role_id'   => ['required'],
            'password'  => ['nullable', Rules\Password::defaults()],
        ]);

        $item->fill([
            'name'      => $request->name,
            'email'     => $request->email,
            'role_id'   => $request->role_id,
            'password'  => empty($request->password) ? Hash::make($request->password) : $item->password,
        ])->save();

        return redirect()->route('users.edit', $item)->with('status', 'user-updated');
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
