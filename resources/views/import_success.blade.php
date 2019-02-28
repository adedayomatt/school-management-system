@extends('layouts.admin')
@section('breadcrumb')

<li class="active">CSV Import</li>
@endsection
@section('content')
    <div class="container">
        <a href="{{ url('/employees/import') }}" class="btn btn-primary">Import Home</a>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">CSV Import</div>

                    <div class="card-body">
                        Data imported successfully.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
