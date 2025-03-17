<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Services\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    private AttributeService $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $response = $this->attributeService->index($perPage);
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE);
    }

    public function store(AttributeRequest $request)
    {
        $response = $this->attributeService->create($request->safe()->toArray());
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE, self::HTTP_CREATED);
    }

    public function update(AttributeRequest $request, $attribute)
    {
        $response = $this->attributeService->update($request->safe()->toArray(), $attribute);
        if (!$response) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse($response, self::SUCCESS_MESSAGE);
    }
}
