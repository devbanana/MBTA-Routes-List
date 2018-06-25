<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoutesRepository;
use App\Models\Route;

/**
 * Route controller for managing routes
 */
class RouteController extends Controller
{

    /**
     * List all routes
     *
     * @return Response
     */
    public function index()
    {

        $routesRepository = new RoutesRepository;
        $routes = $routesRepository
        ->sortBy('type')
        ->get();

        // Sort into route types
        $routesByType = [];
        foreach ($routes as $route) {
            $routesByType[$route->getRouteType()][] = $route;
        }

        return view('routes', ['routesByType' => $routesByType]);
    }

    public function show($id)
    {
        $schedules = Route::getSchedule($id);
        var_dump(count($schedules));
        return view('schedule', ['schedules' => $schedules, 'id' => $id]);
    }
}
