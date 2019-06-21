<div class="card">
        <div class="card-header">
            <h5><i class="fa fa-users"></i> Debtors ({{$fee->debtors()->count()}})</h5>
        </div>
        <div class="card-body p-0" style="max-height: 400px; overflow: auto">
               @if($fee->debtors()->count() > 0)
                    <ul class="list-group">
                        @foreach($fee->debtors() as $debtor)
                            <li class="list-group-item">
                                <a href="{{route('student.show',[$debtor['student']->id])}}">{{$debtor['student']->fullname()}}</a>
                                <div class="d-flex">
                                    <small class="text-muted mr-auto">{{$debtor['student']->classroom->name}}</small>
                                    <small class="text-muted ml-auto">owing <strong>{{number_format($debtor['balance'])}}</strong></small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
               @else
               <div class="text-center">
                    <small class="text-muted">No student is owing this {{$fee->name}}</small>
               </div>
               @endif
        </div>
    </div>
