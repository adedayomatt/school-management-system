<ul class="list-group">
    @if($students->count() > 0)
        @foreach($students as $student)
            <li class="list-group-item">
                <a href="{{route('student.show',[$student->id])}}">{{$student->fullname()}}</a>
                <span class="mx-3">class: <strong><a href="{{route('class.show',[$student->classroom->slug])}}">{{$student->classroom->name}}</a></strong></span> 
            </li>
        @endforeach
    @else

    @endif
</ul>