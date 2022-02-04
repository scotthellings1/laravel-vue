@component('mail::message')
# Daily Summary


@component('mail::table')
|Customer Name           | Customer Email             | Quote Status| Date       | Total|
| :----------------: | :---------------:  | :---------------: | :-------------:| :---------: |
@foreach($quotes as  $q)
|{{$q->customer_name}}|{{$q->customer_email}}|{{$q->status}}| {{date_format($q->created_at, 'd/m/Y')}}|£{{number_format($q->total,2)}}|
@endforeach
@endcomponent

___

**Total:** £{{number_format($total,2)}}

@component('mail::button', ['url' => env('APP_URL') . '/quotes', 'color' => 'green'])
See All Quotes
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
