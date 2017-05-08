<?php

namespace App\Http\Controllers;

use Dingo\Api\Facade\API;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;

class Controller extends BaseController
{
    //
    public function test()
    {
        return json_encode(JWTAuth::attempt(['username'=>123,'password'=>123]));
    }

    public function test1()
    {
        return 123;
    }
}
