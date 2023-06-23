<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use App\Models\Patient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MedicalReportController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $patient = Patient::findorfail($request->patient_id);

        $patient->addMedicalReport($this->ValidatedRequests());
        return redirect()->route('patients.show', $patient)->with('success', 'Report added successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MedicalReport $medicalReport
     * @return Application|Factory|View
     */
    public function edit(MedicalReport $medicalReport)
    {
        return view('front.update-record', compact('medicalReport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MedicalReport $medicalReport
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, MedicalReport $medicalReport)
    {
        $medicalReport->update($this->ValidatedRequests());

        return redirect($medicalReport->patient->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MedicalReport $medicalReport
     * @return RedirectResponse
     */
    public function destroy(MedicalReport $medicalReport): RedirectResponse
    {
        $medicalReport->delete();
        return redirect()->back()->with('success', 'Report deleted successfully.');
    }

    /**
     * Validate the request attributes
     *
     * @return array
     */
    protected function ValidatedRequests(): array
    {
        return request()->validate([
            'patient_id' => 'required',
            'lab_tests_id' => 'required',
            'result' => 'nullable',
            'diagnosis' => 'nullable',
            'prescription'=> 'nullable'
        ]);
    }
}
