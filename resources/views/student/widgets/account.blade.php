@if($student->allFees()->count() > 0)
    @foreach($student->allFees() as $fee)
        <?php $payments = $fee->payments()->where('student_id',$student->id)->get() ?>
        @include('fee.widget')
        @if(!$fee->isForGeneral() && !$fee->isForClasses())
            <div class="text-right">
                <form action="{{route('student.fee.cancel',[$student->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="fee" value="{{$fee->id}}">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> cancel {{$fee->name}} fee for {{$student->enrollment->surname}}</button>
                </form>
            </div>
        @endif
        <br>
    @endforeach
@else
    <div class="alert alert-info">No fee for {{$student->fullname()}} to pay</div>
@endif