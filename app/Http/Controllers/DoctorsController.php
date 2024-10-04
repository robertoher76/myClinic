<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Concerns\CrudController;
use App\Models\Doctor as Model;

class DoctorsController extends CrudController
{
    public function __construct()
    {
        $this->model = new Model();
        parent::__construct();
    }
}
