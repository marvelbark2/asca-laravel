@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'new-city'
])

@section('content')
<section class="container">

        <!-- Header Bar -->
        <header>
            <div class="button-col">
                <button class="btn" name="Add Task"> {{$user->name}} </button>
            </div>

            <div class="status-col">
                <label> Status </label>
            </div>

            <div class="progress-col">
                <label> Progress </label>
            </div>

            <div class="dates-col">
                <label> Dates </label>
            </div>

            <div class="priority-col">
                <label> Priority </label>
            </div>

        </header>

        <!-- List Items -->
        <ul class="task-items">
            @foreach ($s as $i)
            <!-- List Item -->
            <li class="item type{{$rand}}">
                <div class="task">
                    <div class="icon"> </div>
                    <div class="name" style="width:150px"> <p class="text text-center">{{$i->title}}</p> </div>
                </div>

                <div class="status">
                    @if($i->status == 100 || $i->completed == 1)
                    <div class="icon"> </div>
                    <div class="text"> completed </div>
                    @elseif($i->deadline->formatLocalized('%A %d %B %Y') == \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y'))
                        <div class="icon warning"> </div>
                        <div class="text"> At Risk </div>
                    @elseif($i->deadline < \Carbon\Carbon::now())
                        <div class="icon off"> </div>
                        <div class="text"> Off Track </div>
                    @else
                    <div class="icon"> </div>
                    <div class="text"> On Track </div>
                    @endif
                </div>

                <div class="progress" style="
                margin-right: 25px;
            ">
                    <progress value="{{$i->status}}" max="100" />
                </div>

                <div class="dates">
                    <div class="bar"> <p class="text text-center">{{date("d/m/Y", strtotime($i->deadline))}}</p> </div>
                </div>

                <div class="priority">
                    @if ($i->priority == "1")
                    <div class="low"> </div>
                    @elseif ($i->priority == "2")
                    <div class="med"> </div>
                    @else
                    <div class="high"> </div>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>

    </section>
    @push('style')
    <style>
    @import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
    @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    body {
      font-family: "Open Sans", sans-serif;
      background: #eeeeee;
    }

    .container {
      margin: 0 auto;
      margin-top: 50px;
      width: 980px;
    }

    header {
      display: flex;
      align-items: center;
      font-size: 1em;
      font-weight: 600;
      color: #bdbdbd;
      padding: 20px;
      box-sizing: border-box;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;
      text-align: center;
    }
    header .button-col {
      width: 240px;
      text-align: left;
    }
    header .status-col {
      width: 145px;
    }
    header .progress-col {
      width: 190px;
    }
    header .dates-col {
      width: 150px;
    }
    header .priority-col {
      width: 170px;
    }
    header .icon-col {
      width: 30px;
      text-align: right;
    }
    header button {
      color: #bdbdbd;
      outline: none;
      border: none;
      background: #d5d5d5;
      padding: 10px 20px;
      border-radius: 2.5px;
      margin-right: 20px;
      font-size: 1em;
      font-weight: 600;
    }
    header button:hover {
      cursor: pointer;
      background: #3d3d44;
    }
    header label {
      display: inline-block;
      margin: 0 20px;
      text-align: center;
    }
    header .icon-col {
      padding-right: 20px;
    }

    ul.task-items li.item {
      display: flex;
      align-items: center;
      margin: 20px 0;
      padding: 20px;
      background: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.1);
    }
    ul.task-items li.item.type1 .task .icon {
      background: #9575cd;
    }
    ul.task-items li.item.type2 .task .icon {
      background: #f48fb1;
    }
    ul.task-items li.item.type3 .task .icon {
      background: #9575cd;
    }
    ul.task-items li.item.type4 .task .icon {
      background: #4FC3F7;
    }
    ul.task-items li.item .task {
      display: flex;
      align-items: center;
      width: 240px;
    }
    ul.task-items li.item .task .icon {
      background: #bdbdbd;
      width: 50px;
      height: 50px;
      border-radius: 5px;
    }
    ul.task-items li.item .task .name {
      background: #eeeeee;
      margin-left: 20px;
      width: 180px;
      height: 25px;
      border-radius: 15px;
    }
    ul.task-items li.item .status {
      display: flex;
      align-items: center;
      font-size: 1em;
      color: #2e7d32;
      width: 145px;
      margin-left: 30px;
    }
    ul.task-items li.item .status .icon {
      background: #2e7d32;
      margin-right: 10px;
      width: 14px;
      height: 14px;
      border-radius: 50%;
    }
    ul.task-items li.item .status .icon.risk {
      background: red;
    }
    ul.task-items li.item .status .icon.warning {
      background: #FFA000;
    }
    ul.task-items li.item .status .icon.off {
      background: #BF360C;
    }
    ul.task-items li.item .progress {
      width: 190px;
    }
    ul.task-items li.item .progress progress {
      display: block;
      margin-left: 0;
      -webkit-appearance: none;
      height: 12.5px;
      width: 142.5px;
    }
    ul.task-items li.item .progress progress::-webkit-progress-bar {
      background-color: #eeeeee;
      border-radius: 5px;
    }
    ul.task-items li.item .progress ::-webkit-progress-value {
      background-color: #4dd0e1;
      border-radius: 5px;
    }
    ul.task-items li.item .dates {
      width: 150px;
    }
    ul.task-items li.item .dates .bar,
    ul.task-items li.item .priority .bar {
      background: #eeeeee;
      width: 100px;
      height: 25px;
      border-radius: 15px;
    }
    ul.task-items li.item .priority .bar {
      background: #eeeeee;
      width: 100px;
      height: 25px;
      border-radius: 15px;
    }
    ul.task-items li.item .priority {
      width: 144.5px;
    }
    ul.task-items li.item .priority .high {
      background: #ffcdd2;
      width: 100px;
      height: 25px;
      border-radius: 15px;
    }
    ul.task-items li.item .priority .med {
      background: #ffdfcd;
      width: 100px;
      height: 25px;
      border-radius: 15px;
    }
    ul.task-items li.item .priority .low {
      background: #cde1ff;
      width: 100px;
      height: 25px;
      border-radius: 15px;
    }
    ul.task-items li.item .user {
      width: 30px;
    }
    ul.task-items li.item .user img {
      border-radius: 50%;
    }
    </style>
    @endpush
@endsection
