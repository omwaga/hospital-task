@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; align-items: center;" class="m-2">
                            <h6 style="margin-right: auto;" class="text-secondary">Patients</h6>
                            <a href="{{ route('patients.create') }}" class="btn btn-sm btn-danger">Add Patient</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @forelse($patients as $patient)
                                <div class="col-md-4 ">
                                    <div class="card shadow rounded py-2 px-2 my-1">
                                        <h3 class="border-left border-lg border-danger">
                                            <a href="{{$patient->path()}}" class="h4 text-dark" style="text-decoration: none;">{{$patient->name}}</a>
                                        </h3>
                                        <div>Ticket No:. {{ $patient->ticket->ticket_number ?? '' }}</div>
                                    </div>
                                </div>
                            @empty
                                <div>No patients added.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
