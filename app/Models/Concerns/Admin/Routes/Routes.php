<?php

namespace App\Models\Concerns\Admin\Routes;

use Illuminate\Support\Str;

class Routes
{
    private $model;

    private $INDEX;
    private $CREATE;
    private $READ;
    private $UPDATE;
    private $DELETE;
    private $STORE;
    private $EDIT;

    private $IMPORT = false;
    private $EXPORT = false;

    public function __construct(
        ?string $model,
        ?string $index  = null,
        ?string $create = null,
        ?string $read   = null,
        ?string $update = null,
        ?string $delete = null,
        ?string $store = null,
        ?string $edit = null,

        ?string $import = null,
        ?string $export = null
    ) {
        if ($model) {
            $this->model = $this->formatString($model);
        }

        $this->INDEX  = $index;
        $this->CREATE = $create;
        $this->READ   = $read;
        $this->UPDATE = $update;
        $this->DELETE = $delete;
        $this->STORE  = $store;
        $this->EDIT   = $edit;

        $this->IMPORT  = $import;
        $this->EXPORT  = $export;
    }

    public function formatString(string $string): string
    {
        return Str::of(class_basename($string))->lower()->plural()->snake();
    }

    public function formatStringName(): string
    {
        return $this->model;
    }

    public function index(): string
    {
        return $this->INDEX ?? $this->model . '.index';
    }

    public function create(): string
    {
        return $this->CREATE ?? $this->model . '.create';
    }

    public function edit(): string
    {
        return $this->EDIT ?? $this->model . '.edit';
    }

    public function store(): string
    {
        return $this->STORE ?? $this->model . '.store';
    }

    public function update(): string
    {
        return $this->UPDATE ?? $this->model . '.update';
    }

    public function delete(): string
    {
        return $this->DELETE ?? $this->model . '.destroy';
    }

    public function import(): string
    {
        return $this->IMPORT ?? $this->model . '.import';
    }

    public function export(): string
    {
        return $this->EXPORT ?? $this->model . '.export';
    }
}
