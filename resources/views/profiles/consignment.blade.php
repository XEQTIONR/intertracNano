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
  @foreach ($containers as $container)
    <div id="accordion">

      <h3>{{$container->Container_num}}</h3>
      <div>
         @foreach ($contents as $content_one_container) {{--each container--}}

                    {{--@ means if not empty--}}
           @if (@$content_one_container[0]->Container_num==$container->Container_num) {{--if this container--}}
             @foreach($content_one_container as $listing) {{---each tyre qty price etc--}}
               <span>{{$listing->tyre_id}}</span>
               <span>{{$listing->qty}}</span>
               <span>{{$listing->unit_price}}</span><br>
             @endforeach
           @endif

        @endforeach
      </div>
    </div>
  @endforeach
  <button>Add a Container</button>
@endsection
