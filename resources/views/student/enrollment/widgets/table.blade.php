        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Guardian/Parent</th>
                    <th>Seeking admission into</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @if($enrollments->count() > 0)
                @foreach($enrollments as $enrollment)
                    <tr>
                        <td>{{$enrollment->fullname()}}</td>
                        <td>{{$enrollment->dob()}}</td>
                        <td>{{$enrollment->gender}}</td>
                        <td>
                            @if($enrollment->parents->count() > 0)
                            <ul class="list-group">
                                @foreach($enrollment->parents as $parent)
                                    <li class="list-group-item">{{$parent->fullname()}}({{$parent->relation}})</li>
                                @endforeach
                            </ul>
                            @else
                                <small class="text-center text-danger">No parent/guardian found</small>
                            @endif
                        </td>
                        <td>{{$enrollment->seeking_admission_into}}</td>
                        <td>
                            <a href="{{route('enrollment.show',[$enrollment->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> view enrollment</a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-danger" >No enrollment found</td>
                    </tr>
                @endif

            </tbody>
        </table>
