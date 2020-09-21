@extends('layouts.app')

@section('title')
  Home
@endsection

@section('body')

  <h2>Welcome to <b>nanoDB</b></h2>
  <p>Stock and accounting tool for Intertrac Nano</p>
  <p>Current version : <b>{{ config('app.version') }}</b></p>

  <span>Server Time : <b>{{$now->toDayDateTimeString()}}</b></span> <br>
  <span>Local Time : <b v-cloak id="app">@{{ date_string }}</b></span>
@endsection


@section('footer-scripts')
  <script>

    var app = new Vue({

        el: '#app',
        data : {
          sth : 'WHAT',
          date_string : ''
        },

        created : function(){
            this.tickOn();
        },
        methods : {

            tickOn : function() {
                console.log('tickoncalled');
                var timerID = setInterval(function(){

                    var local = new Date();
                    var hours = local.getHours() % 12;
                    var minutes = local.getMinutes();
                    var seconds = local.getSeconds();
                    var ampm = hours > 0 ? 'PM' : 'AM';

                    hours = hours < 10 ? ('0'+hours) : hours;
                    minutes = minutes < 10 ? ('0'+minutes) : minutes;
                    seconds = seconds < 10 ? ('0'+seconds) : seconds;

                    app.date_string = hours+':'+minutes+':'+seconds+' '+ampm;
                }, 1000)

            }
        },
        computed : {
            date : function(){
                 return Date();
            }
        }
    })

  </script>
@endsection