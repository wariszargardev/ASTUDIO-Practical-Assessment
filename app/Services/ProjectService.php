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
        $project = $user->projectsCreatedByUser()->create($data);

        // If we want to assign the project to the user who created it
        // Otherwise we can remove this line
        $project->users()->attach($user->id);
        return $project;
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

    public function assign($projectId)
    {
        $project = $this->model->with('users')->find($projectId);
        if (!$project) {
            return false;
        }
        $user = auth()->user();
        if (!$project->users()->where('user_id', $user->id)->exists()) {
            $project->users()->attach($user->id);
        }
        // We project is already assigned to the user we can return other message
        // But for now we are just returning the project
        return $project->refresh();
    }

    public function unAssign($projectId)
    {
        $project = $this->model->with('users')->find($projectId);
        if (!$project) {
            return false;
        }
        $user = auth()->user();
        if ($project->users()->where('user_id', $user->id)->exists()) {
            $project->users()->detach($user->id);
        }
        // We project is not assigned to the user we can return other message
        // But for now we are just returning the project
        return $project->refresh();
    }
}
