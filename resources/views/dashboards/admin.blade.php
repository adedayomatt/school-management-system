
<div class="fixed-operations-pane" style="overflow: unset">
    @include('student.enrollment.widgets.search')
</div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="overflow: unset !important">
                    @include('staff.widgets.search')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('payment.widgets.verify')
                </div>
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Students</h4>
                </div>
                <div class="card-body text-center">
                    <h1>{{$_students::all()->count()}}</h1>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{route('student.index')}}"><i class="fa fa-eye"></i> view</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Enrollment</h4>
                </div>
                <div class="card-body text-center">
                    <h1>{{$_pending_enrollments->count()}}<span style="font-size: 15px"> Pending</span></h1>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{route('enrollment.index')}}"><i class="fa fa-eye"></i> view</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Staff</h4>
                </div>
                <div class="card-body text-center">
                    <h1>{{$_staffs::all()->count()}}</h1>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{route('staff.index')}}"><i class="fa fa-eye"></i> view</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Classes</h4>
                </div>
                <div class="card-body text-center">
                    <h1>{{$_classes::all()->count()}}</h1>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{route('class.index')}}"><i class="fa fa-eye"></i> view</a>
                    </div>
                </div>

            </div>
        </div>

   </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Recently added students</h4>
                </div>
                <div class="card-body">
                <?php $students = $_students::orderby('created_at','desc')->take(8)->get()?>
                         @include('student.widgets.table')
                </div>
            </div>

            <div class="text-right">
                <a href="{{route('student.index')}}">All students</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Recently confirmed payments</h4>
                </div>
                <div class="card-body">
                <?php $payments = $_payments::orderby('created_at','desc')->take(8)->get()?>
                         @include('payment.widgets.table')
                </div>
            </div>

            <div class="text-right">
                <a href="{{route('payments')}}">All payments</a>
            </div>

        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Classes</h4>
                </div>
                <div class="card-body p-0">
                    @if($_classes::all()->count()  >0 )
                        <ul class="list-group">
                            @foreach($_classes::orderby('created_at','desc')->take(5)->get() as $class)
                                <li class="list-group-item">
                                    <a href="{{route('class.show',$class->slug)}}">{{$class->name}}</a> 
                                    <span class="badge badge-primary ">{{$class->students->count()}} students</span>
                                    <br>
                                     {!!$class->teachers()!!}
                                 </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">No class yet </div>
                        <a href="{{route('class.create')}}" class="btn btn-sm btn-primary">create a class</a>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <a href="{{route('class.index')}}" >All classes</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Fees</h4>
                </div>
                <div class="card-body p-0">
                    @if($_fees::all()->count()  >0 )
                        <ul class="list-group">
                            @foreach($_fees::orderby('created_at','desc')->take(5)->get() as $fee)
                                <li class="list-group-item"><a href="{{route('fee.show',$fee->id)}}">{{$fee->name}}</a> <br> <span class="badge badge-secondary">{{$fee->payments->count()}} payments</span></li>
                            @endforeach
                        </ul>
                    @else
                    <div class="p-2">
                        <div class="text-danger text-center">No fee yet </div>
                        <a href="{{route('fee.create')}}" class="btn btn-sm btn-primary">create fee</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <a href="{{route('fee.index')}}" >All fees</a>
            </div>

        </div>
    </div>
