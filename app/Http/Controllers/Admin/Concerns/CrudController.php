<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CrudController extends Controller
{
    protected $model;

    public function __construct() {
        if ($this->showNotFoundError()) abort(404);
    }

    private function showNotFoundError()
    {
        return !$this->model;
    }

    public function index() : View
    {
        //if (!$this->model->permissions()->canIndex()) abort(403);

        return view('admin.layouts.index', [
            'model' => new $this->model,
        ]);
    }

    public function create() : View
    {
        //if (!$this->model->permissions()->canCreate()) abort(403);

        return view( 'admin.' . $this->model->routes()->formatStringName() . '.create', [
            'model' => new $this->model,
        ]);
    }

    public function edit($item) : View
    {
        //if (!$this->model->permissions()->canRead()) abort(403);

        return view('admin.' . $this->model->routes()->formatStringName() . '.edit', [
            'model' => $this->model::findOrFail($item),
        ]);
    }

    public function store(Request $request)
    {
        $item = new $this->model;

        $request->validate($item->rules($item->id ?? null));

        $item->fill($request->except($this->exceptAttributes()))->save();

        return redirect()->route($item->routes()->edit(), $item->id)->with('status', 'role-updated');
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);

        $request->validate($item->rules($item->id ?? null));

        $item->fill($request->except($this->exceptAttributes()))->save();

        return redirect()->route($item->routes()->edit(), $item->id)->with('status', 'model-updated');
    }

    private function exceptAttributes(): array
    {
        $attributes = [];

        if ($this->model->hs_active_storage) {
            $attributes = array_merge($attributes, $this->model->imageable());
        }

        return $attributes;
    }

    public function destroy(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);

        //if (!$this->model->permissions()->canDelete()) abort(403);

        $item->delete();

        return redirect()->route($this->model->routes()->index());
    }
}
