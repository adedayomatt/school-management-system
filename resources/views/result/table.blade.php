@if($results->count() > 0)
    <table class="table table-bordered table-striped">
        <thead>
            <th>Student</th>
            <th>Term</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td><a href="{{route('student.show',[$result->student])}}">{{$result->student->fullname()}}</a></td>
                    <td>{{$result->term->session}}, {{$result->term->term()}}</td>
                    <td>
                        <form action="{{route('result.print')}}" method="POST">
                            @csrf
                            <input type="hidden" name="term" value="{{$result->term->id}}">
                            <input type="hidden" name="student" value="{{$result->student->id}}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print result</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
<div class="text-center text-danger">
    <i class="fa fa-exclamation-triangle"></i> No result found
</div>
@endif
