@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="list-group">
                @foreach ($notifications as $notification)
                    <li class="list-group-item" @if($notification->read_at == null) style="font-weight:bold" @endif>
                        <a href="{{ url("notifications/{$notification->id}") }}">
                            {{ trans('notifications.'.class_basename($notification->type), $notification->data) }}
                        </a>
                        
                        <br> {{ $notification->created_at->format('d/m/Y H:ia') }}
                    </li>
                @endforeach    
            </ul> 

            <p><a href="notifications/read-all">Mark all as read</a></p>
        </div>
    </div>
</div>
@endsection

