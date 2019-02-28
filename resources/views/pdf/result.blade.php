@extends('layouts.result')

@section('result-table')
    <table border="1" class="text-center">
        <thead>
            <tr>
                <th style="text-align: left">Subject</th>
                <th>Test score</th>
                <th>Exam score</th>
                <th>Total</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @if($results->count() > 0)
                @foreach($results as $result)
                    <tr>
                        <td style="text-align: left">{{$result->subject->name}}</td>
                        <td>{{$result->test}}</td>
                        <td>{{$result->exam}}</td>
                        <td>{{$result->total()}}</td>
                        <td>{{$result->grade()}}</td>
                    </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
@endsection