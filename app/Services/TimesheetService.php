<?php

namespace App\Services;

class TimesheetService extends BaseService
{
    public function createTimesheet($data)
    {
        $user = auth()->user();
        return $user->timesheets()->create($data);
    }

    public function updateTimesheet($data, $id)
    {
        $timeSheet = $this->getUserTimeSheets()->where('id', $id)->first();
        if (!$timeSheet) {
            return false;
        }
        $timeSheet->update($data);
        return $timeSheet;
    }

    private function getUserTimeSheets()
    {
        $user = auth()->user();
        return $user->timesheets()->get();
    }

    public function deleteTimesheet($id)
    {
        $timeSheet = $this->getUserTimeSheets()->where('id', $id)->first();
        if (!$timeSheet) {
            return false;
        }
        return $timeSheet->delete();
    }
}
