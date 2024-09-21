<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Concerns\CrudController;
use App\Models\Service;

class ServicesController extends CrudController
{
    public function __construct()
    {
        $this->model = new Service();
        parent::__construct();
    }
}
