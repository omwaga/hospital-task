<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Patient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LabTestController extends Controller
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

        $patient->addLabTest($this->ValidatedRequests());

        return redirect()->route('patients.show', $patient)->with('success', 'Lab Test added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LabTest $labTest
     * @return Application|Factory|View
     */
    public function edit(LabTest $labTest)
    {
        return view('front.update-lab-test', compact('labTest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param LabTest $labTest
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, LabTest $labTest)
    {
        $labTest->update($this->ValidatedRequests());

        return redirect($labTest->patient->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LabTest $labTest
     * @return RedirectResponse
     */
    public function destroy(LabTest $labTest): RedirectResponse
    {
        $labTest->delete();
        return redirect()->back()->with('success', 'Lab test deleted successfully.');
    }

    /**
     * Validate the request attributes
     *
     * @return array
     */
    protected function ValidatedRequests(): array
    {
        return request()->validate([
            'name' => 'required|min:3',
            'patient_id' => 'required'
        ]);
    }
}
