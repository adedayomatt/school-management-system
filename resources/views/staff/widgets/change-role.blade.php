    <form action="{{route('staff.role.change',[$staff->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div id="choose-class" class="d-flex">
            <div  class="form-group">
                <select name="role" id="class" class="select2" class="form-control" style="width: 200px" required>
                    <option  value="">Select role</option>
                    @foreach($_roles::all() as $role)
                        <option value="{{$role->id}}" {{$role->id === $staff->role_id ? 'selected' : ''}}> {{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group ml-2">
                <input type="submit" value="Change role" class="btn btn-primary">
            </div>
        </div>
        
    </form>
