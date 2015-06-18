<?php

namespace Spartz\Http\Controllers;

use Illuminate\Http\Request;

use Spartz\Http\Requests;
use Spartz\Http\Controllers\Controller;
use Spartz\State;
use Spartz\Transformers\StateTransformer;
use \Fractal;

class StatesController extends Controller
{
    public function __construct(State $states)
    {
        $this->states = $states;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $states = $this->states->orderBy('name', 'ASC')->paginate( $request->get('limit', 12) );

        return Fractal::collection($states, new StateTransformer)->responseJson(200);
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
     * @param  int  $state
     * @return Response
     */
    public function show($state)
    {
        return Fractal::item($state, new StateTransformer)->responseJson(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $state
     * @return Response
     */
    public function edit($state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $state
     * @return Response
     */
    public function update($state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $state
     * @return Response
     */
    public function destroy($state)
    {
        //
    }
}
