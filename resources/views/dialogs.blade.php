@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dialog</div>
                <div class="panel-body">
                    <h2>{{$first->title}}</h2>
                    @if ($first->img != "")
                        <img src="/uploads/{{$first->img}}" style="max-width: 120px">
                    @endif
                    <table class="table table-bordered">
                     <tbody>
                        <tr><td>
                            <dialog-component user="{{$first->user->name}}" role="{{$first->user->role}}" dt="{{\Carbon\Carbon::parse($first->created_at)->format('d.m.Y H:i:s')}}" msgtext="{{$first->msg}}"></dialog-component>
                        </td>
                        </tr>
                     @foreach ( $msgs as $msg )
                        <tr>
                            <td><dialog-component user="{{$msg->user->name}}" role="{{$msg->user->role}}" dt="{{\Carbon\Carbon::parse($msg->created_at)->format('d.m.Y H:i:s')}}" msgtext="{{$msg->msg}}"></dialog-component>
                            </td>
                        </tr>
                     @endforeach
                     </tbody>
                    </table>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/dialog') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
                            <label for="msg" class="col-md-4 control-label">Message*</label>

                            <div class="col-md-6">
                                <textarea name='msg' rows=5 cols=50>{{ old('msg') }}</textarea>

                                @if ($errors->has('msg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('msg') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Reply
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="feedback_id" value="{{$first->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
