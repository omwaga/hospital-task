<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\MedicalReport;
use Illuminate\Support\Facades\Auth;

class MedicalReportObserver
{
    /**
     * Handle the MedicalReport "created" event.
     *
     * @param MedicalReport $medicalReport
     * @return void
     */
    public function created(MedicalReport $medicalReport)
    {
        $this->recordActivity($medicalReport, 'created_report');
    }

    /**
     * Handle the MedicalReport "updated" event.
     *
     * @param MedicalReport $medicalReport
     * @return void
     */
    public function updated(MedicalReport $medicalReport)
    {
        $this->recordActivity($medicalReport, 'updated_report');
    }

    /**
     * Handle the MedicalReport "deleted" event.
     *
     * @param MedicalReport $medicalReport
     * @return void
     */
    public function deleted(MedicalReport $medicalReport)
    {
        $this->recordActivity($medicalReport, 'deleted_report');
    }

    /**
     * Record Activity.
     *
     */
    protected function recordActivity($medicalReport, $type)
    {
        Activity::create([
            'patient_id' => $medicalReport->patient->id,
            'user_id' =>  Auth::id(),
            'description' => $type
        ]);
    }
}
