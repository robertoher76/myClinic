<?php

namespace App\Models\Concerns\Admin\Filters;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Field {

    private string $type;
    private string $label;
    private string $field;
    private bool $can_sort;
    private array $config;

    private $valid_types = [
        'none',
        'text',
        'number',
        'date',
        'datetime',
        'select',
        'checkbox',
        'email',
        'enum'
    ];

    public function __construct(
        string $type,
        string $label,
        string $field,
        bool $can_sort = true,
        array $config = [],

    ) {
        $this->setType($type);
        $this->setLabel($label);
        $this->setField($field);
        $this->can_sort = $can_sort;
        $this->setConfig($config);
    }

    private function setType(string $type)
    {
        $this->type = $type;
    }

    private function setLabel(string $label)
    {
        $this->label = $label;
    }

    private function setField(string $field)
    {
        $this->field = $field;
    }

    private function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Getters
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function canSort(): bool
    {
        return $this->can_sort;
    }

    public function getConfig(): array
    {
        return $this->config ?? [];
    }
}
