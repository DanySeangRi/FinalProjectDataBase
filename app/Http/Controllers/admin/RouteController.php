<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;


class RouteController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->search;


        $routes = Route::query()

            ->when($search, function($query) use ($search){

                $query->where('origin','like',"%{$search}%")
                      ->orWhere('destination','like',"%{$search}%");

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();


        return view(
            'admin.routes.index',
            compact('routes','search')
        );

    }




    public function store(Request $request)
    {

        $request->validate([

            'origin'=>'required',
            'destination'=>'required',
            'distance'=>'nullable|integer',
            'duration'=>'nullable|string'

        ]);



        Route::create([

            'origin'=>$request->origin,
            'destination'=>$request->destination,
            'distance'=>$request->distance,
            'duration'=>$request->duration

        ]);



        return response()->json([
            'message'=>'Route created'
        ]);

    }





    public function update(Request $request, Route $route)
    {


        $request->validate([

            'origin'=>'required',
            'destination'=>'required',
            'distance'=>'nullable|integer',
            'duration'=>'nullable|string'

        ]);



        $route->update($request->all());



        return response()->json([
            'message'=>'Route updated'
        ]);

    }





    public function destroy(Route $route)
    {


        $route->delete();


        return response()->json([
            'message'=>'Route deleted'
        ]);

    }


}