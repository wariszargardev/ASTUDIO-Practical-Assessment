<?php

namespace App\Services;

use App\Models\Attribute;

class AttributeService
{
    private $model;

    public function __construct()
    {
        $this->model = new Attribute();
    }

    public function index(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        $attribute = $this->model->find($id);
        if (!$attribute) {
            return false;
        }
        $attribute->update($data);
        return $attribute;
    }
}
