    <div class="card">
        <div class="card-header">
            <h5><i class="fa fa-users"></i> Payable by</h5>
            <small class="text-muted">{{$fee->target}}</small>
        </div>
        <div class="card-body p-0" style="max-height: 400px; overflow: auto">
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
                    </ul>
                @endif
        </div>
        <div class="card-footer">
            @if($fee->isForClasses())
                <small>Attach this fee to other classes</small>
                <form action="{{route('fee.attach.classes',[$fee->id])}}" method="POST">
                    @csrf
                    <select name="classrooms[]" class="form-control select2" multiple  style="width: 70%">
                    @foreach($_classes::whereNotIn('id', $fee->classroomsArray())->get() as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                    @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary" style="border-radius: 0px 3px 3px 0px"><i class="fa fa-plus"></i></button>
                </form>

            @endif
            @if($fee->isForStudents())
                <small>Attach this fee to other students</small>
                <form action="{{route('fee.attach.students',[$fee->id])}}" method="POST">
                    @csrf
                    <select name="students[]" class="form-control select2" multiple  style="width: 70%">
                        @foreach($_students::whereNotIn('id', $fee->studentsArray())->get() as $student)
                            <option value="{{$student->id}}">{{$student->fullname()}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary" style="border-radius: 0px 3px 3px 0px"><i class="fa fa-plus"></i></button>
                </form>
            @endif

        </div>
    </div>
    <button class="btn btn-danger btn-sm m-2" data-toggle="collapse" data-target="#fee-{{$fee->id}}-delete-confirm"><i class="fa fa-ban"></i> cancel fee and all related payments</button>
    <div class="collapse" id="fee-{{$fee->id}}-delete-confirm">
        <form action="{{route('fee.destroy',[$fee->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="alert alert-warning">
                Are you sure you want to cancel all {{$fee->payments->count()}} payments for {{$fee->name}}
            </div>
            <a href="#" class="btn btn-sm btn-primary m-1" data-toggle="collapse" data-target="#fee-{{$fee->id}}-delete-confirm">No</a>
            <button class="btn btn-danger btn-sm m-1"><i class="fa fa-ban"></i> Yes, cancel</button>
        </form>
    </div>