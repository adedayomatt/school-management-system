<table class= "table table-striped table-bordered" id="filterTable">
    <thead>
        <th>Name</th>
        <th>Role</th>
        <th>Class</th>
        <th>Phone</th>
        <th>Email</th>
    </thead>

    <tbody>
        @if($staffs->count()> 0)
            @foreach($staffs as $staff)
                <tr>
                    <td><a href="{{ route('staff.show', [$staff->id]) }}">{{ $staff->fullname() }}</a></td>
                    <td>{{ $staff->role === null ? 'No role' : $staff->role->name }}</td>
                    <td>
                        @if($staff->hasClass())
                            <a href="{{route('class.show',[$staff->classroom->slug])}}">{{$staff->classroom->name}}</a>
                        @else
                            <small class="text-warning">no class assigned</small>
                        @endif
                    </td>
                    <td>{{ $staff->phone }}</td>
                    <td>{{ $staff->email }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center"><small class="text-danger">  No staff found</small></td>
            </tr>
        @endif
    </tbody>

</table>
@if($staffs instanceof \Illuminate\Pagination\LengthAwarePaginator )
        {!!$staffs->links()!!}
 @endif

