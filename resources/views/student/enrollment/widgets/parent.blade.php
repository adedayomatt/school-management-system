    @if($enrollment->parents->count() > 0)
        @foreach($enrollment->parents as $parent)
            <div class="card">
                <div class="card-header">
                    <strong>{{$parent->fullname()}}</strong>
                    <br>{{$parent->relation}}
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"> Ocuppation: <strong>{{$parent->occupation}}</strong></li>
                        <li class="list-group-item"> Business Address: <strong>{{$parent->business_address}}</strong></li>
                        <li class="list-group-item"> Phone: <strong>{{$parent->phone}}</strong></li>
                        <li class="list-group-item"> Email: <strong>{{$parent->email}}</strong></li>
                    </ul>                
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center alert alert-warning">
            No parent/guardian found
        </div>
    @endif