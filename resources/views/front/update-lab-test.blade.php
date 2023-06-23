@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Update '). $labTest->name . ' Data for ' . $labTest->patient->name }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('lab-tests.update', $labTest) }}">
                            @method('PUT')
                            @csrf

                            <input type="hidden" value="{{ $labTest->patient->id }}" name="patient_id">
                            <div class="row mb-3">
                                <label for="result" class="col-md-4 col-form-label text-md-end">{{ __('Lab Test Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" value="{{ $labTest->name }}" class="form-control @error('name') is-invalid @enderror" name="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ $labTest->patient->path() }}">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
