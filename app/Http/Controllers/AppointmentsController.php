<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Role;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    protected $model;

    public function __construct() {
        $this->model = new Appointment();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.appointments.index', [
            'model' => $this->model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();

        return view('admin.appointments.create', [
            'model'     => $this->model,
            'patients'  => $patients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id'    => [ 'required', 'integer' ],
            'scheduled_at'  => [ 'required' ]
        ]);

        $role = Appointment::create([
            'patient_id'    => $request->patient_id,
            'scheduled_at'  => $request->scheduled_at,
            'status'        => 1
        ]);

        return redirect()->route('appointments.index')->with('status', 'role-updated');
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
    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();

        return view('admin.appointments.edit', [
            'model'     => $appointment,
            'patients'  => $patients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
