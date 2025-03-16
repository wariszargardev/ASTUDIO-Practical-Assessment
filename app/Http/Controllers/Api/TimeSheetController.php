<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TimeSheetRequest;
use App\Services\TimesheetService;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class TimeSheetController extends Controller
{
    private TimesheetService $timesheetService;
    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeSheetRequest $request)
    {
        $timesheet = $this->timesheetService->createTimesheet($request->validated());
        return ApiResponse::successResponse($timesheet, self::SUCCESS_MESSAGE, self::SUCCESS_STATUS, self::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimesheetRequest $request, $id)
    {
        $updatedTimesheet = $this->timesheetService->updateTimesheet($request->validated(), $id);
        if (!$updatedTimesheet) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE . ' OR ' . self::NOT_BELONGS_TO_YOU, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse($updatedTimesheet, self::SUCCESS_MESSAGE, self::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->timesheetService->deleteTimesheet($id);
        if (!$response) {
            return ApiResponse::errorResponse(self::NOT_FOUND_MESSAGE . ' OR ' . self::NOT_BELONGS_TO_YOU, self::ERROR_STATUS, self::HTTP_NOT_FOUND);
        }
        return ApiResponse::successResponse(null, self::SUCCESS_MESSAGE, self::HTTP_OK);
    }
}
