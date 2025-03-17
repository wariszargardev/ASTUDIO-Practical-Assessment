<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Services\AttributeValueService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectService $projectService;
    private AttributeValueService $attributeValueService;

    public function __construct(ProjectService $projectService, AttributeValueService $attributeValueService)
    {
        $this->projectService = $projectService;
        $this->attributeValueService = $attributeValueService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $response= $this->projectService->index($perPage);
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE, self::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectCreateRequest $request)
    {
        $project= $this->projectService->create($request->safe()->toArray());

        // Handling project attributes values
        $this->attributeValueService->createOrUpdate($project, $request->safe()->toArray());
        return ApiResponse::successResponse($project, self::SUCCESS_MESSAGE, self::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = $this->projectService->show($id);
        if (!$response) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, string $id)
    {
        $project = $this->projectService->update($request->safe()->toArray(), $id);
        if (!$project) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE . ' OR ' . self::NOT_BELONGS_TO_YOU, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        // Handling project attributes values
        $this->attributeValueService->createOrUpdate($project, $request->safe()->toArray());
        return ApiResponse::successResponse($project, self::SUCCESS_MESSAGE, self::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ApiResponse::successResponse([], "We will implement in  nearest future" ,self::NO_CONTENT);

        $response= $this->projectService->delete($id);
        if (!$response) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE . ' OR ' . self::NOT_BELONGS_TO_YOU, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse([], self::SUCCESS_MESSAGE ,self::NO_CONTENT);
    }

    public function assign($project)
    {
        $response = $this->projectService->assign($project);
        if (!$response) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE, self::SUCCESS_STATUS, self::HTTP_CREATED);
    }

    public function unAssign($project)
    {
        $response = $this->projectService->unAssign($project);
        if (!$response) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE, self::SUCCESS_STATUS);
    }
}
