@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Patient') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('patients.update', $patient) }}">
                            @method('PUT')
                            @include('front._patients-form', ['project' => $patient,'buttonText' => 'Update Patient'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
