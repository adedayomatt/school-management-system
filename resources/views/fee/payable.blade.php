    <div class="card">
        <div class="card-header">
            <h5><i class="fa fa-users"></i> Payable by</h5>
        </div>
        <div class="card-body">
        @if($fee->isForGeneral())
                <div class="text-center">All students</div>
        @else
            <ul class="list-group">
                @if($fee->classrooms->count() > 0)
                    @foreach($fee->classrooms as $class)
                        <li class="list-group-item"><a href="{{route('class.show',[$class->id])}}">{{$class->name}}</a></li>
                    @endforeach
                @endif
                @if($fee->students->count() > 0)
                    @foreach($fee->students as $student)
                        <li class="list-group-item"><a href="{{route('student.show',[$student->id])}}">{{$student->fullname()}}</a></li>
                    @endforeach
                @endif
        @endif
            </ul>
        </div>
    </div>