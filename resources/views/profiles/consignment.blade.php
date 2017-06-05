@extends('layout.mainlayout')

@section('content')

  <table>
    <tr>
      <td>Bill of Lading#</td>
      <td>{{$consignment->BOL}}</td>
    </tr>
    <tr>
      <td>LC#</td>
      <td>{{$consignment->lc}}</td>
    </tr>
    <tr>
      <td>Landed On</td>
      <td>{{$consignment->land_date}}</td>
    </tr>
    <tr>
      <td>Exchange_rate</td>
      <td>{{60}}</td> {{--Change 60 to exchange_rate--}}
    </tr>
    <tr>
      <td>Total Value (Foreign)</td>
      <td>{{$consignment->value}}</td>
    </tr>
    <tr>
      <td>Total Value (Local)</td>
      <td>{{$consignment->value * 60}}</td> {{--change 60 to excahnge rate--}}
    </tr>
    <tr>
      <td>Total Tax Charged (TK)</td>
      <td>{{$consignment->tax}}</td>
    </tr>
  </table>

  {{-- view containers section--}}

  <button>Add a Container</button>
@endsection
