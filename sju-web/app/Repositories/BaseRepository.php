<?php

namespace App\Repositories;

use CodeIgniter\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function findAll(array $conditions = [])
    {
        if (! empty($conditions)) {
            return $this->model->where($conditions)->findAll();
        }

        return $this->model->findAll();
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->insert($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->model->delete($id);
    }
}