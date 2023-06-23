@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="display: flex; align-items: center;" class="m-2">
                    <p style="margin-right: auto;" class="text-secondary">
                        <a href="{{route('patients.index')}}">Patients</a> / {{$patient->name}}
                    </p>
                    <a href="{{route('generate-report', $patient)}}" class="btn btn-success mx-2">Print Report</a>
                    <a href="{{$patient->path().'/edit'}}" class="btn btn-danger">Edit Patient</a>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card p-3">
                            <div>{{$patient->name}}</div>
                            <div>{{$patient->ticket->ticket_number}}</div>
                        </div>

                        <main class="mt-5">
                            <h4 style="margin-right: auto;" class="text-secondary">Lab Tests</h4>

                            @foreach($patient->labTests as $test)
                                <div class="card p-3 mb-3">
                                    <div>

                                        <div class="row">
                                            <div class="col-10">
                                                {{ $test->name }}
                                            </div>
                                            <div class="col-2">

                                                <div class="btn-group float-right" role="group">
                                                    <a type="button" rel="tooltip" class="btn btn-success btn-sm " href="{{ route('lab-tests.edit', $test) }}" title="Edit">
                                                        <i class="fa fa-pencil-square-o pt-1"></i>
                                                    </a>
                                                    <form action="{{ route('lab-tests.destroy', $test) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" rel="tooltip" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fa fa-trash-o pt-1"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <h6 style="margin-right: auto;" class="text-secondary">Medical Reports</h6>
                                        <table class="table align-items-center table-sm" id="datatable-basic">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">#</th>
                                                <th scope="col" class="sort" data-sort="budget">Result</th>
                                                <th scope="col" class="sort" data-sort="budget">Diagnosis</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="list">
                                            @forelse($test->medicalReports as $report)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{$report->diagnosis}}
                                                    </td>
                                                    <td>
                                                        {{$report->result}}
                                                    </td>
                                                    <td class="">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a type="button" rel="tooltip" class="btn btn-success btn-sm" href="{{ route('medical-reports.edit', $report) }}" title="Edit">
                                                                <i class="fa fa-pencil-square-o pt-1"></i>
                                                            </a>
                                                            <form action="{{ route('medical-reports.destroy', $report) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" rel="tooltip" class="btn btn-danger btn-sm" title="Delete">
                                                                    <i class="fa fa-trash-o pt-1"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td class="text-center" colspan="4">No Data</td>
                                            @endforelse
                                            </tbody>
                                        </table>

                                        <form method="POST" action="{{ route('medical-reports.store') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                                            <input type="hidden" value="{{ $test->id }}" name="lab_tests_id">
                                            <div class="row mb-3">
                                                <label for="result" class="col-md-4 col-form-label text-md-end">{{ __('Result') }}</label>

                                                <div class="col-md-6">
                                                    <textarea id="result" type="text" class="form-control @error('result') is-invalid @enderror" name="result">{{ old('result') }}</textarea>

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
                                                    <textarea id="diagnosis" type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis">{{ old('diagnosis') }}</textarea>

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
                                                    <textarea id="prescription" type="text" class="form-control @error('prescription') is-invalid @enderror" name="prescription">{{ old('prescription') }}</textarea>

                                                    @error('prescription')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-0">
                                                <div class="col-md-6 offset-md-9">
                                                    <button type="submit" class="btn btn-primary">Add Report</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <div class="card p-3 mb-3">
                                <div>
                                    <h4 class="h6">New Lab Test</h4>
                                    <form method="POST" action="{{ route('lab-tests.store') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                                        <div class="row mb-3">

                                            <label for="result" class="col-md-4 col-form-label text-md-end">{{ __('Lab Test Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" placeholder="Add a new lab test ..." type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name">

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-9">
                                                <button type="submit" class="btn btn-primary">Add Lab Test</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </main>

                        <a href="{{route('patients.index')}}"> Go Back</a>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3">
                            <h3 class="border-left border-lg border-danger">
                                <a href="" class="h6 text-dark" style="text-decoration: none;">Record Activity</a>
                            </h3>
                            <ul>
                                @foreach($patient->activity as $activity)
                                    <li>
                                        @include("front.activity.{$activity->description}")
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
