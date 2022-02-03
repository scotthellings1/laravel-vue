@component('mail::message')

    # Please see your quote details:

    **To:** {{ $quote->customer_name }}

    **Email:** {{$quote->customer_email}}

    @component('mail::table')
        |Product           | Qty              | Unit cost       | Total                          |
        | :----------------: | :---------------:  | :---------------: | :------------------------------: |
        @foreach($quote->products as $p)
            |{{$p->name}}      |{{$p->pivot->qty}}|£{{number_format($p->price,2)}}   |£ {{number_format($p->pivot->qty *
$p->price,2)}}|
        @endforeach
    @endcomponent

    ___
    **Subtotal:** £{{number_format($quote->total/1.2, 2)}}

    **VAT:** £{{number_format($quote->total - $quote->total/1.2, 2 )}}

    **Total:** £{{number_format( $quote->total,2) }}


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
