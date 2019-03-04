<li class="treeview">
          <a href="#">
            <i class="fas fa-user-plus"></i>
            <span>Enrollments</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('enrollment.create') }}"><i class="fa fa-plus-square"></i> New enrollment</a></li>
            <li> 
              <a href="{{route('enrollment.index')}}">
                <i class="fas fa-user-clock"></i>
                <span>Pending enrollments <span class="badge badge-info">{{$_pending_enrollments->count()}}</span></span>
                </a> 
              </li>  
              <li><a href="{{ route('enrollment.bin') }}"><i class="fa fa-trash"></i> Bin</a></li>
  
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Classes</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('class.create') }}"><i class="fa fa-plus-square"></i> New class</a></li>
            <li><a href="{{ route('class.index') }}"><i class="fa fa-users"></i> All classes</a></li>
            @if($_classes::all()->count() > 0)
              @foreach($_classes::all()->take(5) as $class)
                <li>
                  <a href="{{ route('class.show',[$class->slug]) }}"><i class="fa fa-chair"></i> {{$class->name}}</a>
                </li>
              @endforeach
            @endif
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Subjects</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('subject.create') }}"><i class="fa fa-plus-square"></i> New subject</a></li>
            <li><a href="{{ route('subject.index') }}"><i class="fa fa-book"></i> All subjects</a></li>
            @if($_classes::all()->count() > 0)
              @foreach($_subjects::all()->take(5) as $subject)
                <li>
                  <a href="{{ route('subject.show',[$subject->slug]) }}"><i class="fa fa-book"></i> {{$subject->name}}</a>
                </li>
              @endforeach
            @endif
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-tie"></i>
            <span>Staff</span>

          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('staff.create') }}"><i class="fa fa-plus-square"></i> New staff</a></li>
            @if($_staffs::all()->count() > 0)
              @foreach($_staffs::orderby('created_at','desc')->take(5)->get() as $staff)
                <li><a href="{{ route('staff.show',[$staff->id]) }}"><i class="fa fa-user-tie"></i> {{$staff->fullname()}}</a></li>
              @endforeach
            @endif
            <li><a href="{{ route('staff.index') }}"><i class="fa fa-user-tie"></i> All staff</a></li>

          </ul>
          
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-tag"></i>
            <span>Staff role</span>

          </a>
          <ul class="treeview-menu">
            @if($_roles::all()->count() > 0)
              @foreach($_roles::all() as $role)
                <li><a href="{{ route('role.show',[$role->slug]) }}"><i class="fa fa-user-tag"></i> {{$role->name}}</a></li>
              @endforeach
            @endif
            <!-- <li><a href="{{ route('role.index') }}"><i class="fa fa-user-tag"></i> All staff role</a></li> -->

          </ul>

        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-graduate"></i>
            <span>Students</span>

          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('student.index') }}"><i class="fa fa-user-graduate"></i> All students</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fas fa-file-invoice"></i>
            <span>Fees</span>

          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('fee.create') }}"><i class="fa fa-plus-square"></i> New fee</a></li>
            @if($_fees::all()->count() > 0)
              @foreach($_fees::all() as $fee)
                <li><a href="{{ route('fee.show',[$fee->id]) }}"><i class="fas fa-file-invoice"></i> {{$fee->name}}</a></li>
              @endforeach
            @endif
            <li><a href="{{ route('fee.index') }}"><i class="fas fa-file-invoice"></i> All fees</a></li>
          </ul>
        </li>

        <li>
          <a href="{{route('payments')}}">
            <i class="fas fa-money-bill-alt"></i>
            <span>Payments</span>
          </a>
        </li>

        <li>
          <a href="{{route('parents')}}">
            <i class="fa fa-user-friends"></i>
            <span>Parents/Guardians</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fas fa-upload"></i>
            <span>Import</span>

          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('staff.import.form') }}"><i class="fas fa-upload"></i> Import staff records</a></li>
            <li><a href="{{ route('student.import.form') }}"><i class="fas fa-upload"></i> Import student records</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fas fa-calendar"></i>
            <span>Academic Term</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('term.create') }}"><i class="fas fa-plus"></i> New term</a></li>
            @if($_terms::all()->count() > 0)
              @foreach($_terms::all() as $term)
                <li><a href="{{ route('term.show',[$term->id]) }}"><i class="fas fa-calendar"></i> {{$term->session}} ({{$term->term()}})</a></li>
              @endforeach
            @endif
            <li><a href="{{ route('term.index') }}"><i class="fas fa-calendar"></i> All academic terms</a></li>
          </ul>
        </li>

        <li>
          <a href="{{route('portal.settings.edit')}}">
            <i class="fas fa-cog"></i>
            <span>Portal settings</span>
          </a>
        </li>
        <li>
          <a href="{{route('grade.settings.edit')}}">
            <i class="fas fa-graduation-cap"></i>
            <span>Grades</span>
          </a>
        </li>