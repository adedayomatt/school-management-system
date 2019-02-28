    @if($staff->isTeacher() || $staff->isAsstTeacher())
    <form action="{{route('staff.class.assign',[$staff->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div id="choose-class" class="d-flex">
            <div  class="form-group">
                <select name="class" id="class" class="select2" class="form-control" style="min-width: 100px" required>
                    <option value="">Select class</option>
                    @foreach($_classes::all() as $class)
                        <option value="{{$class->id}}" {{$class->id === $staff->classroom_id ? 'selected' : ''}}> {{$class->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group ml-2">
                <input type="submit" value="Assign class" class="btn btn-primary">
            </div>
        </div>
        
    </form>
    @else
        <div class="alert alert-warning">
            Classes can only be assigned to teachers and asst. teachers. {{$staff->surname}} is a/an {{$staff->role->name}}
        </div>
    @endif
