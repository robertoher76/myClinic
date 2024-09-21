<?php

namespace App\Livewire\Admin\Concerns;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;

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
        return view('livewire.admin.layouts.table', [
            'data' => $this->getRecords()
        ]);
    }

    private function getRecords()
    {
        $data = $this->model->
                        where('name', 'like', '%'.$this->query.'%')
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
