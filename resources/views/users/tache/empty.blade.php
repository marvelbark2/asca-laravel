@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'new-city'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <p class="text text-primary text-center">Pas des taches assignee {{$user->name}}  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
