<?php
            $myClass = Auth::user()->profile->classroom;
            ?>

        <li>
          <a href="{{route('staff.show',[Auth::user()->profile->id])}}">
            <i class="fas fa-user"></i>
            <span>My file</span>
          </a>
        </li>


@if($myClass != null)
        <li>
          <a href="{{route('class.show',[$myClass->id])}}">
            <i class="fas fa-chair"></i>
            <span>My class</span>
          </a>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fas fa-pen"></i>
            <span>Record Scores</span>
          </a>
          <ul class="treeview-menu">
            @if($myClass->subjects->count() > 0)
              @foreach($myClass->subjects as $sub)
                <li><a href="{{ route('result.record',[$myClass->id,$sub->id]) }}"><i class="fas fa-pen"></i> {{$sub->name}}</a></li>
              @endforeach
              @else
                <li><a href="#"><i class="fas fa-ban"></i> No subject</a></li>
            @endif
          </ul>
        </li>
@endif