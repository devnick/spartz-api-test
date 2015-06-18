<?php

namespace Spartz\Http\Controllers;

use Illuminate\Http\Request;

use Spartz\Http\Requests;
use Spartz\Http\Controllers\Controller;
use Spartz\State;
use Spartz\City;
use Spartz\Transformers\StateTransformer;
use Spartz\Transformers\CityTransformer;
use \Fractal;

class StatesCitiesController extends Controller
{
    public function __construct(State $states)
    {
        $this->states = $states;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $state
     *
     * @return Response
     */
    public function index($state, Request $request)
    {
        $cities = $state->cities()->paginate($request->get('limit', 12));

        return Fractal::collection($cities, new CityTransformer)->responseJson(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $state
     *
     * @return Response
     */
    public function create($state)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $state
     *
     * @return Response
     */
    public function store($state)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $state
     * @param  int  $city
     *
     * @return Response
     */
    public function show($state, $city)
    {
        if ($state->exists === true && $city->exists === true)
        {
            if ($city->state->id === $state->id) return Fractal::item($city, new CityTransformer)->responseJson(200);
        }

        return response()->json(['error' => true], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $state
     * @param  int  $city
     *
     * @return Response
     */
    public function edit($state, $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $state
     * @param  int  $city
     *
     * @return Response
     */
    public function update($state, $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $state
     * @param  int  $city
     *
     * @return Response
     */
    public function destroy($state, $city)
    {
        //
    }
}
