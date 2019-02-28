        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Class</th>
                    <th>Guardian/Parent</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @if($students->count() > 0)
                @foreach($students as $student)
                    <tr>
                        <td><a href="{{route('student.show',[$student->id])}}">{{$student->enrollment->fullname()}}</a></td>
                        <td>{{$student->enrollment->dob()}}</td>
                        <td>{{$student->enrollment->gender}}</td>
                        <td><a href="{{route('class.show',[$student->classroom->slug])}}">{{$student->classroom->name}}</a></td>
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
                @else
                    <tr>
                        <td colspan="6" class="text-center text-danger" >No student found</td>
                    </tr>
                @endif

            </tbody>
        </table>
        @if($students instanceof \Illuminate\Pagination\LengthAwarePaginator )
            {!!$students->links()!!}
        @endif
