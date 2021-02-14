@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tache-index'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Taches non assignees</h4>
                    </div>
                    <div class="card-body">
                      <ul class="list-group">
                        @foreach ($taches as $i)
                        <li class="list-group-item">
                                <div class="row">
                                    <div class="col text-left">
                                    <a class="text-primary"><i class="material-icons">{{$i->title}}</i></a>
                                    </div>
                                    <div class="col text-right">
                                    <a href="/tache/{{ $i->id }}"  class="text-primary"><i class="nc-icon nc-minimal-right"></i></a>
                                    </div>
                            </li>
                        @endforeach
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
