<table class= "table table-striped table-bordered">
    <thead>
        <th>Student</th>
        <th>Fee</th>
        <th>Ammount</th>
        <th>Ammount paid</th>
        <th>Aggregate Payment</th>
        <th>Balance</th>
        <th></th>
    </thead>

    <tbody>
        @if($payments->count()> 0)
            @foreach($payments->sortBy('created_at') as $payment)
                @if($payment->fee != null)
                    <tr>
                        <td><a href="{{route('student.show',[$payment->student->id])}}">{{ $payment->student->fullname() }}</a></td>
                        <td><a href="{{route('fee.show',[$payment->fee->id])}}">{{ $payment->fee->name }}</a></td>
                        <td>{{number_format($payment->fee->ammount)}}</td>
                        <td>
                            {{ number_format($payment->ammount) }}
                            <div class="text-right">
                                <small>{{$payment->created_at->toDayDateTimeString()}}</small>
                            </div>                        
                        </td>
                        <td>{{ number_format($payment->student->aggregatePayment($payment->fee->id)) }}</td>
                        <td>{{ number_format($payment->balance) }}</td>
                        <td><a href="{{route('payment.receipt',[$payment->ref])}}" class="btn btn-success btn-sm"><i class="fa fa-receipt"></i> Receipt</a></td>
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center"><small class="text-danger">  No payment found</small></td>
            </tr>
        @endif
    </tbody>
</table>
