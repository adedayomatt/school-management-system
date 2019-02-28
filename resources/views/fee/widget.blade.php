				<div class="card">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-md-6">
								<h3><i class="fas fa-file-invoice"></i> <a href="{{route('fee.show',[$fee->id])}}">{{$fee->name}}</a></h3>
								<p>{{$fee->purpose !== null ? $fee->purpose : ''}}</p>
							</div>
							<div class="col-md-4">
								<h1 >{{number_format($fee->ammount)}}</h1>
							</div>
							<div class="col-md-2">
								<a href="{{isset($student) ? route('student.fee.pay',[$student->id,$fee->id]) : route('fee.pay',[$fee->id])}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-hand-holding-usd"></i> New payment</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="card-title">
							<h4>Payments</h4>
						</div>
						@include('payment.widgets.table')
					</div>
				</div>
