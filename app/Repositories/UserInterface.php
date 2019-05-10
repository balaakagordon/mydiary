<?php

namespace App\Repositories;

interface UserInterface {

    public function validateCredentials($request);

    public function createUser($credentials);

    public function getToken($user);

    public function successResponse($success);

    public function unauthorizedResponse($error = 'Unauthorized');

}