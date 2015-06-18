<?php

namespace Spartz\Http\Controllers;

use Illuminate\Http\Request;
use Spartz\Http\Requests;
use Spartz\Http\Controllers\Controller;
use Spartz\User;
use Spartz\Transformers\UserTransformer;
use \Fractal;

class UsersController extends Controller
{
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->users->paginate( $request->get('limit', 12) );

        return Fractal::collection($users, new UserTransformer)->responseJson(200);
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
     * @param  int  $user
     * @return Response
     */
    public function show($user)
    {
        return Fractal::item($user, new UserTransformer)->responseJson(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user
     * @return Response
     */
    public function edit($user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $user
     * @return Response
     */
    public function update($user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return Response
     */
    public function destroy($user)
    {
        //
    }
}
