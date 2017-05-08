<?php

namespace App\Http\Controllers;

use App\Exceptions\testException;
use App\User;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Facade\API;
use Dingo\Api\Http\Middleware\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Transformers\UserTransformer;


class Controller extends BaseController
{
    use Helpers;

    //
    public function test()
    {
        return json_encode(Auth::attempt(['username' => 123, 'password' => '123']));
        //User::create(['username'=>55555,'password'=>bcrypt('fuckyou')]);
        //return 1;
    }

    public function test1()
    {
        //JWTAuth::unsetToken();
        //Auth::logout();
        //return 1;
        //$user = User::find(3);
        //return $this->response->item($user,new UserTransformer());
        //return $this->response->array($user->toArray());
        //return $this->response->noContent();
        //return JWTAuth::refresh();
    }

    /**
     *  参数验证失败返回错误信息处理
     * @param $validator
     */
    protected function errorBadRequest($validator)
    {
        $msg=$validator->errors()->toArray();
        $result=[];
        if($msg){
            foreach($msg as $param => $errors){
                foreach ($errors as $error){
                    $result[]=[
                        'param'  => $param,
                        'result' => $error
                    ];
                }
            }
        }

         throw new ValidationHttpException($result);
    }
}
