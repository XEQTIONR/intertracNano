@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br>
                    Date{{$date}}<br>
                    Year{{$date->year}}<br>
                    Month{{$date->month}}<br>
                    Day{{$date->day}}<br>

                    We have {{$count}} orders on the month of {{$date->month}} year of {{$date->year}} <br>
                    Total tyres sold{{$count_tyres}}<br>
                    Total Value{{$total_value}}<br>
                    Avg Value per tyre{{$avg_value}}<br>
                    No of order with payment{{$orders_with_payments}}<br>
                    Orders fully paid{{$orders_full_paid}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
