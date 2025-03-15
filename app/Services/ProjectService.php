<?php

namespace App\Services;

use App\Models\Project;

class ProjectService extends BaseService
{
    private $model;

    public function __construct()
    {
        $this->model = new Project();
    }

    public function index(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function create($data)
    {
        $user = auth()->user();
        return $user->projectsCreatedByUser()->create($data);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($data, $id)
    {
        $project = $this->getUserProjects()->where('id', $id)->first();
        if (!$project) {
            return false;
        }
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        $project = $this->getUserProjects()->where('id', $id)->first();
        if (!$project) {
            return false;
        }
        return $project->delete();
    }

    private function getUserProjects()
    {
        $user = auth()->user();
        return $user->projectsCreatedByUser()->get();
    }
}
