<?php

namespace App\Models\Concerns\Admin\Filters;

use App\Models\Concerns\Admin\Filters\Field;

class Filter
{
    private $filter;

    public function __construct(Field ...$fields) {
        $this->filter = $fields;
    }

    public function getFilter() {
        return $this->filter;
    }

    public function getFields(): array {
        $fields = [];

        $fields[] = 'id';

        foreach ($this->getFilter() as $item) {
            $fields[] = $item->getField();
        }

        return $fields;
    }
}
