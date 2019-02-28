<form action ="{{ route('payment.store') }}" method="POST">
    @csrf

    <div class="form-group">
        @if(isset($fee))
            <input type="hidden" name="fee" value="{{$fee->id}}">
        @else
            <label for="fee">Fee</label>
            <select name="fee" id="fee" class="form-control select2" style="width: 100%" required>
                <option value="">Select fee you are paying for</option>
                @foreach($_fees::orderby('created_at','desc')->get() as $_fee)
                    <option value="{{$_fee->id}}" {{old('fee') === $_fee->id ? 'selected' : ''}}>{{$_fee->name}} ({{number_format($_fee->ammount)}})</option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="form-group">
        @if(isset($student))
            <input type="hidden" name="student" value="{{$student->id}}">
        @else
            <label for="student">Student paying</label>
            <select name="student" id="student" class="form-control select2" style="width: 100%" required>
                <option value="">Select student</option>
                @foreach($_students::orderby('created_at','desc')->get() as $student)
                   @if(isset($fee))
                        @if($student->canPay($fee->id))
                            <option value="{{$student->id}}" {{old('student') === $student->id ? 'selected' : ''}}>{{$student->enrollment->fullname()}}-{{$student->classroom->name}} (Outstanding - N {{number_format($student->balanceOf($fee->id))}})</option>
                        @endif
                    @else
                        <option value="{{$student->id}}" {{old('student') === $student->id ? 'selected' : ''}}>{{$student->enrollment->fullname()}}-{{$student->classroom->name}} </option>
                    @endif
                @endforeach
            </select>
        @endif
    </div>
					

    <div class="form-group">
        <label for="ammount">Ammont paying</label>
        <input type="number" name="ammount" class="form-control" value="{{old('ammount')}}" required>
    </div>
    
    <div class="form-group">
        <div class="text-center">
            <button class ="btn btn-primary" type="submit">Approve payment</button>
        </div>
    </div>
</form>