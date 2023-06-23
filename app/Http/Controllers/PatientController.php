<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $patients = Patient::all();
        return view('front.patients', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('front.add-patient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // save the validated patient data
        $patient = Patient::create($this->ValidatedRequests());

        // Redirect to patients
        return redirect()->route('patients.index')->with('success', 'Patient registered successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param Patient $patient
     * @return Application|Factory|View
     */
    public function show(Patient $patient)
    {
        return view('front.show-patient', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Patient $patient
     * @return Application|Factory|View
     */
    public function edit(Patient $patient)
    {
        return view('front.update-patient', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Patient $patient
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Patient $patient)
    {
        $patient->update($this->ValidatedRequests());

        return redirect($patient->path());
    }


    /**
     * Generate Patient Report.
     *
     * @param Patient $patient
     * @return Response
     */
    public function generateReport(Patient $patient): Response
    {
        $pdf = PDF::loadView('front.report', compact('patient'));
        return $pdf->download('Report.pdf');

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
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable'
        ]);
    }
}
