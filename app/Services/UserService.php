<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repositories\UserInterface;

class UserService implements UserInterface
{
    public function validateCredentials($request)
    {
        return Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'confirmedPassword' => 'required|same:password',
        ]);
    }

    public function createUser($credentials)
    {
        $credentials['password'] = bcrypt($credentials['password']);
        $credentials['provider'] = 'mydiary';
        $credentials['provider_id'] = 'mydiary';
        return User::create($credentials);
    }

    public function updateUserData($user, $action, $field, $data)
    {
        if ($data->getData()->status === 'success') {
            if ($action === 'increment') {
                User::find($user->id)->increment($field);
            } else if ($action === 'decrement') {
                User::find($user->id)->decrement($field);
            }
        }
        return $data;
    }

    public function getToken($user)
    {
        $success['token'] = $user->createToken('MyDiary')->accessToken;
        $success['firstName'] = $user->firstName;
        $success['lastName'] = $user->lastName;
        return $success;
    }

    public function successResponse($data)
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => $data
            ],
            200
        );
    }

    public function unauthorizedResponse($data = 'Unauthorized')
    {
        return response()->json(
            [
                'status' => 'error',
                'data' => $data
            ],
            401
        );
    }
}