<ul class="list-group">
    @if($staffs->count() > 0)
        @foreach($staffs as $staff)
            <li class="list-group-item">
                <a href="{{route('staff.show',[$staff->id])}}">{{$staff->fullname()}}</a>
                <div>
                    <span class="mx-3">role: <strong><a href="{{route('role.show',[$staff->role->id])}}">{{$staff->role->name}}</a></strong></span> 
                    <span class="mx-3">class: <strong><a href="{{route('class.show',[$staff->class->id])}}">{{$staff->class->name}}</a></strong></span> 
                </div>
            </li>
        @endforeach
    @else

    @endif
</ul>