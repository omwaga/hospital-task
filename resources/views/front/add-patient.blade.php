@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Patient') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('patients.store') }}">
                            @include('front._patients-form', ['project' => new App\Models\Patient,'buttonText' => 'Add Patient'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
