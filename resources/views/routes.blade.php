@extends('layouts.layout')

@section('title')
    MBTA Routes
@endsection

@section('content')
    <table border="1" cellpadding="3" cellspacing="3">
        <thead>
            <tr>
                <th>Route</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routesByType as $type => $routes)
            <tr>
                <th colspan="2"><h2>{{$routes[0]->getReadableRouteType()}}</h2></th>
            </tr>
            @foreach ($routes as $route)
            <tr>
                <th style="background-color: #{{$route->getColor()}}; color: {{$route->getTextColor()}}">
                    <a href="/routes/{{$route->getId()}}">{{$route->getLongName()}}</a>
                </th>
                <td style="background-color: #{{$route->getColor()}}; color: {{$route->getTextColor()}}">
                    {{$route->getDescription()}}
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
