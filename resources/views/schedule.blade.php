@extends('layouts.layout')

@section('title')
    Schedule for {{$id}}
@endsection

@section('content')
<p><a href="/">Back to Routes</a></p>
@foreach($schedules as $schedule)
<dl>
    <dt>Arrival Time</dt>
    <dd>{{$schedule->arrival_time->format('F j, g:i A')}}</dd>
    <dt>Departure Time</dt>
    <dd>{{$schedule->departure_time->format('F j, g:i A')}}</dd>
<dt>Drop Off Type</dt>
<dd>{{$schedule->drop_off_type}}</dd>
<dt>Pick Up Type</dt>
<dd>{{$schedule->pickup_type}}</dd>
<dt>Stop Sequence</dt>
<dd>{{$schedule->stop_sequence}}</dd>
<dt>Stop ID</dt>
<dd>{{$schedule->stop_id}}</dd>
</dl>
@endforeach
@endsection
