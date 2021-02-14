@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'new-city'
])

@section('content')
    <div class="content">
        <h4 class="card-title"> les taches assignee a {{$user->name}}</h4>
        <div class="row">
            @foreach ($s as $i)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" >
                    <h4 style="float: left;" class="card-title"> {{$i->title}}</h4>
                    <h4 style="float: right;" class="card-title">
                    @if ($i->priority == '1')
                    <span class="badge badge-light">Basse</span>
                    @elseif ($i->priority == '2')
                    <span style="color:whitesmoke" class="badge badge-warning">Moyenne</span>
                    @elseif ($i->priority == '3')
                    <span class="badge badge-danger">Urget</span>
                    @endif
                    </h4>
                    </div>
                    <div class="card-body">
                    <ul>
                    <li>Statut : {{$i->status}}</li>
                    <li>Test : 1</li>
                    <li>Test : 2</li>
                    <li>Test : 3</li>
                    </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
