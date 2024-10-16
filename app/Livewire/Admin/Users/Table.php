<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Table extends Component
{
    use WithPagination;

    public $model;
    public $query = '';
    public $field = 'id';
    public $asc = true;

    public $fields;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->fields = $this->model->filter()->getFields();
    }

    public function render()
    {
        return view('livewire.admin.users.table', [
            'data' => $this->getRecords()
        ]);
    }

    private function getRecords()
    {
        $id = Auth::id();

        $data = $this->model->
                        where('name', 'like', '%'.$this->query.'%')
                        ->where('id', '!=', $id)
                        ->select($this->fields)
                        ->orderBy($this->field, $this->asc ? 'ASC' : 'DESC')
                        ->paginate(10);

        return $data;
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function setSort($field)
    {
        $this->asc = !$this->asc;

        $this->field = $field;
    }
}
