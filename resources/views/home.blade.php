@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>
                    {{$date}}<br>
                    {{$date->year}}<br>
                    {{$date->month}}<br>
                    {{$date->day}}<br>

                    We have {{$count}} orders on the month of {{$date->month}} year of {{$date->year}} <br>
                    {{$count_tyres}}<br>
                    {{$total_value}}<br>
                    {{$avg_value}}<br>
                    {{$orders_with_payments}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
