<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserInterface;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Authenticate a returning user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success = $this->users->getToken($user);
            return $this->users->successResponse($success);
        }

        return $this->users->unauthorizedResponse();
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->users->validateCredentials($request);

        if ($validator->fails()) {
            return $this->users->unauthorizedResponse($validator->errors());
        }
        $input = $request->all();
        $user = $this->users->createUser($input);
        $success = $this->users->getToken($user);

        return $this->users->successResponse($success);
    }

    /**
     * Display a user's details.
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $user = Auth::user();
        // $user = $request->user();

        return $this->users->successResponse($user);
    }
}
