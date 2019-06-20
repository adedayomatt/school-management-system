<div class="card">
    <div class="card-body text-center">
        <h2>How is it going today {{Auth::user()->profile->fullname()}}</h2>
    </div>
</div>
@if(Auth::user()->profile->hasClass())

    <div class="card">
        <div class="card-header">
            <h4>Student Attendance Today <strong>{{ \Carbon\Carbon::now()->format('l jS \\of F Y ') }}</strong></h4>
        </div>
        <div class="card-body">
            <?php
            $class = Auth::user()->profile->classroom
            ?>
           @include('class.single-class')
        </div>
    </div>
@else
    <div class="alert alert-warning text-center">
        <i class="fa fa-exclamation-triangle"></i> You have not been assigned to any class yet
    </div>
@endif

