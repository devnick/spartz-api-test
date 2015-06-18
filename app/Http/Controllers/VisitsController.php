<?php

namespace Spartz\Http\Controllers;

use Illuminate\Http\Request;
use Spartz\Http\Requests;
use Spartz\Http\Controllers\Controller;
use Spartz\City;
use Spartz\Transformers\CityTransformer;
use \Fractal;

class VisitsController extends Controller
{
    public function __construct(City $cities)
    {
        $this->cities = $cities;
    }

    public function index($user)
    {
        return Fractal::collection($user->cities, new CityTransformer)->responseJson(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($user, Request $request)
    {
        $state = $request->get('state', null);
        $city  = $request->get('city', null);

        if ($user->exists)
        {
            $city = $this->cities
                         ->where('name', $city)
                         ->whereHas('state', function ($q) use ($state) {
                            $q->where('name', $state);
                         })
                         ->first();

            if ($city)
            {
                if (!$user->cities->contains($city->id))
                {
                    $user->cities()->attach($city->id);

                    return response()->json([
                        'succes' => true,
                        'message' => 'This location has been marked as visited.'
                    ], 200);

                }

                return response()->json([
                    'succes'  => false,
                    'message' => 'The user already has visited this location.'
                ], 400);
            }
        }

        return response()->json([
            'succes' => false,
            'message' => 'There was a problem saving this location.'
        ], 400);
    }
}
