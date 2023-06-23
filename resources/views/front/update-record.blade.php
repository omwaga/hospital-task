@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Update '). $medicalReport->labTest->name . ' Data for ' . $medicalReport->patient->name }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('medical-reports.update', $medicalReport) }}">
                            @method('PUT')
                            @csrf

                            <input type="hidden" value="{{ $medicalReport->patient->id }}" name="patient_id">
                            <input type="hidden" value="{{ $medicalReport->labTest->id }}" name="lab_tests_id">
                            <div class="row mb-3">
                                <label for="result" class="col-md-4 col-form-label text-md-end">{{ __('Result') }}</label>

                                <div class="col-md-6">
                                    <textarea id="result" type="text" class="form-control @error('result') is-invalid @enderror" name="result">{{ $medicalReport->result }}</textarea>

                                    @error('result')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="diagnosis" class="col-md-4 col-form-label text-md-end">{{ __('Diagnosis') }}</label>

                                <div class="col-md-6">
                                    <textarea id="diagnosis" type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis">{{ $medicalReport->diagnosis }}</textarea>

                                    @error('diagnosis')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="prescription" class="col-md-4 col-form-label text-md-end">{{ __('Prescription') }}</label>

                                <div class="col-md-6">
                                    <textarea id="prescription" type="text" class="form-control @error('prescription') is-invalid @enderror" name="prescription">{{ $medicalReport->prescription }}</textarea>

                                    @error('prescription')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ $medicalReport->patient->path() }}">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
