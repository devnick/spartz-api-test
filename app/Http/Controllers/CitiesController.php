<?php

namespace Spartz\Http\Controllers;

use Illuminate\Http\Request;
use Spartz\Http\Requests;
use Spartz\Http\Controllers\Controller;
use Spartz\City;
use Spartz\Transformers\CityTransformer;
use \Fractal;

class CitiesController extends Controller
{

    public function __construct(City $cities)
    {
        $this->cities = $cities;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cities = $this->cities->paginate($request->get('limit', 12));

        return Fractal::collection($cities, new CityTransformer)->responseJson(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $city
     * @return Response
     */
    public function show($city)
    {
        return Fractal::item($city, new CityTransformer)->responseJson(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $city
     * @return Response
     */
    public function edit($city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $city
     * @return Response
     */
    public function update($city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $city
     * @return Response
     */
    public function destroy($city)
    {
        //
    }
}
