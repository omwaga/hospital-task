<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\LabTest;
use Illuminate\Support\Facades\Auth;

class LabTestObserver
{
    /**
     * Handle the LabTest "created" event.
     *
     * @param LabTest $labTest
     * @return void
     */
    public function created(LabTest $labTest)
    {
        $this->recordActivity($labTest, 'created_test');
    }

    /**
     * Handle the LabTest "updated" event.
     *
     * @param LabTest $labTest
     * @return void
     */
    public function updated(LabTest $labTest)
    {
        $this->recordActivity($labTest, 'updated_test');
    }

    /**
     * Handle the LabTest "deleted" event.
     *
     * @param LabTest $labTest
     * @return void
     */
    public function deleted(LabTest $labTest)
    {
        $this->recordActivity($labTest, 'deleted_test');
    }

    /**
     * Record Activity.
     *
     */
    protected function recordActivity($labTest, $type)
    {
        Activity::create([
            'patient_id' => $labTest->patient->id,
            'user_id' =>  Auth::id(),
            'description' => $type
        ]);
    }
}
