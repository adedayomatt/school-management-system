<table class= "table table-striped table-bordered payments-table">
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
            @foreach($payments->sortByDesc('created_at') as $payment)
                @if($payment->fee != null && $payment->student != null)
                    <tr class="operations-wrapper">
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
                        <td>{{ number_format($payment->student->balanceOf($payment->fee->id)) }}</td>
                        <td >
                            <div class="operations-container">
                                <a href="{{route('payment.receipt',[$payment->ref])}}" class="btn btn-success btn-sm m-1"><i class="fa fa-receipt"></i> Receipt</a>
                                <a href="#" class="btn btn-sm btn-danger m-1" data-toggle="collapse" data-target="#payment-{{$payment->ref}}" ><i class="fa fa-ban"></i> cancel</a>
                                <div class="collapse" data-parent=".payments-table" id="payment-{{$payment->ref}}">
                                    <form action="{{route('payment.destroy',[$payment->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="alert alert-warning">
                                            Are you sure you want to cancel the payment of <strong>{{number_format($payment->ammount)}}</strong> for <strong>{{$payment->student->fullname()}}</strong>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-primary"data-toggle="collapse" data-target="#payment-{{$payment->ref}}" >No</button>
                                            <button type="submit" class="btn btn-sm btn-danger">Yes, cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </td>
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
