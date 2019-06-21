@extends('layouts.dashboard')
@section('breadcrumb')
<li class="breadcrumb-item active">Backups</li>
@endsection

@section('content')

    <div class="row justify-content-center">

        <div class="col-sm-10">
            <div class="card">
                <div class="card-header clearfix">
                    <h6>Backups</h6>
                    <a href="{{ route('backup.create') }}" class="btn btn-sm btn-primary float-right">
                        <i class="fa fa-plus"></i> Create New Backup
                    </a>
                </div>
                <div class="card-body">
                    @if (count($backups) > 0)

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>File</th>
                                <th>Size</th>
                                <th>Date</th>
                                <th>Age</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1; ?>
                            @foreach($backups as $backup)

                                <tr>
                                    <td>{{ $backup['file_name'] }}</td>
                                    <td>{{ humanFilesize($backup['file_size']) }}</td>
                                    <td>
                                        {{ formatTimeStamp($backup['last_modified'], 'F jS, Y, g:ia') }}
                                    </td>
                                    <td>
                                        {{$backup['age']}}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-primary" href="{{ route('backup.download',[$backup['file_name']]) }}" style="border-radius: 3px 0px 0px 3px">
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                            <button class="btn btn-sm btn-danger" data-toggle="collapse" data-target="#delete-backup-{{$counter}}" style="border-radius: 0px 3px 3px 0px">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </div>
                                        <div class="collapse p-2" id="delete-backup-{{$counter}}" data-parent="body">
                                            <p><i class="fa fa-exclamtion-triangle"></i> Are you sure you want to delete this backup from <strong>{{$backup['age']}}</strong> ago?. This action is not reversible!</p>
                                            <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#delete-backup-{{$counter}}" >
                                                Don't delete
                                            </button>
                                            <a class="btn btn-sm btn-danger" data-button-type="delete" href="{{ route('backup.delete',[$backup['file_name']]) }}">
                                                Yes, delete please
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <?php $counter++; ?>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-muted text-center">
                            <h4><i class="fa fa-exclamation-triangle"></i></h4>
                            <p>No backup found</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection