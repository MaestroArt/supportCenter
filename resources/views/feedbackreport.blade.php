@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Feedbacks</div>
                <div class="panel-body">
                    
                    <table class="table table-bordered">
                     <thead>
                     <tr>
                        @foreach ( $columns as $col )
                            <th>{{$names[$col]}}</th>
                        @endforeach
                     </tr>
                     </thead>
                     <tbody>
                     @foreach ( $msgs as $msg )
                        <tr>
                            @foreach ( $columns as $col )
                                <td>
                                    @if($col=='created_at')
                                        {{\Carbon\Carbon::parse($msg->created_at)->format('d.m.Y H:i:s')}}
                                    @else
                                        @if($col=='user_id')
                                            <a href="{{ URL::to('dialog', $msg->id) }}"> {{$msg->user->name}}</a>
                                        @else
                                            <a href="{{ URL::to('dialog', $msg->id) }}"> {{$msg[$col]}}</a>
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                     @endforeach

                     </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
