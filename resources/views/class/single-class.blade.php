<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><i class="fa fa-chair"></i> {{ $class->name }}</h4>
            </div>
            <div class="card-body">
                Teacher: 
                @if($class->staff->count() > 0)
                    @foreach($class->staff as $teacher)
                        <a href="{{route('staff.show',[$teacher->id])}}">{{$teacher->fullname()}}</a>@if(!$loop->last), @endif
                    @endforeach
                @else
                    <small class="text-danger">No teacher assigned yet</small>
                @endif
                    <div>
                    Subjects: 
                    @if($class->subjects->count() > 0)
                        @foreach($class->subjects as $subject)
                            <a href="{{route('subject.show',[$subject->id])}}">{{$subject->name}}</a>@if(!$loop->last) , @endif
                        @endforeach
                    @else
                        <span class="text-danger">No subject offering</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4><i class="fa fa-users"></i> Students in {{$class->name}} ({{$class->students->count()}})</h4>
    </div>
    <div class="card-body">
    <form action="{{Auth::user()->isAdmin() ? route('class.change') : (Auth::user()->isTeacher() ? route('class.attendance',[$class->id]): '')}}" method="POST">
        @csrf
        @method('PUT')

    <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Guardian/Parent</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @if($class->students->count() > 0)
                @foreach($class->students as $student)
                    <tr>
                        <td>

                    @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                        <div class="custom-control custom-checkbox m-2">
                            <input type="checkbox" class="custom-control-input" id="student{{$student->id}}" name="students[]" value="{{$student->id}}" >
                            <label class="custom-control-label" for="student{{$student->id}}"></label>
                        </div>
                    @elseif(Auth::user()->isTeacher())
                        <!-- <div class="custom-control custom-checkbox m-2">
                            <input type="checkbox" class="custom-control-input" id="student{{$student->id}}" name="students[]" value="{{$student->id}}" {{$student->attendance(\Carbon\Carbon::now()->format('Y-m-d')) != null && $student->attendance(\Carbon\Carbon::now()->format('Y-m-d'))->isPresent() ? 'checked' : ''}}>
                            <label class="custom-control-label" for="student{{$student->id}}">{{$student->attendance(\Carbon\Carbon::now()->format('Y-m-d')) != null && $student->attendance(\Carbon\Carbon::now()->format('Y-m-d'))->isPresent() ? 'unmark present' : 'mark present'}}</label>
                        </div> -->
                    @endif
            
                        </td>
                        <td><a href="{{route('student.show',[$student->id])}}">{{$student->enrollment->fullname()}}</a></td>
                        <td>{{$student->enrollment->dob()}}</td>
                        <td>{{$student->enrollment->gender}}</td>
                        <td>
                            @if($student->enrollment->parents->count() > 0)
                                <ul class="list-group">
                                    @foreach($student->enrollment->parents as $parent)
                                        <li class="list-group-item">
                                            {{$parent->fullname()}}({{$parent->relation}})
                                            <div class="text-right">
                                                @if($parent->phone != null && $parent->phone != '' && is_numeric($parent->phone))<i class="fa fa-phone"></i> {{$parent->phone}}@endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <small class="text-center text-danger">No parent/guardian found</small>
                            @endif
                        </td>
                        <td><a href="{{route('student.show',[$student->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> view student</a></td>
                    </tr>
                @endforeach

            </form>
                @else
                    <tr>
                        <td colspan="7" class="text-center text-danger" >No student found</td>
                    </tr>
                @endif

            </tbody>
        </table>
            <div class="fixed-operations-pane">
                @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                    <a href="{{ route('class.edit', [$class->slug ]) }}" class="btn btn-sm btn-primary m-2"> <i class="fa fa-pen"></i> edit class</a>
                    <button type="button" data-toggle="collapse" data-target="#select-new-class" class="btn btn-primary btn-sm m-2">Change class of selected students</button>
                    <div class="collapse" id="select-new-class">
                    <div class="d-flex">
                            <div class="form-group">
                                <select name="new_class" class="form-control">
                                    <option value="">Select new class</option>
                                    @foreach($_classes::all() as $cls)
                                        @if($cls->id !== $class->id)
                                            <option value="{{$cls->id}}">{{$cls->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mx-2">
                                <input type="submit" class="btn btn-info btn-sm" value="Change class">
                            </div>
                    </div>
                    </div>
                @elseif(Auth::user()->isTeacher())
                    <!-- <div class="mx-2">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> {{$class->attendanceMarkedToday() ? "update today's attendance" : "Mark selected students as present"}}</button>
                    </div> -->
                @endif
                <a href="{{route('class.results',[$class->id])}}" class="btn btn-primary btn-sm m-2"><i class="fa fa-file-alt"></i> Results</a>
            </div>
                

        </form>
    </div>
</div>
