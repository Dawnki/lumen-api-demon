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
use Illuminate\Support\Facades\URL;
use Laravel\Lumen\Routing\Controller as BaseController;
use Swagger\Annotations\Swagger;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Transformers\UserTransformer;


class Controller extends BaseController
{
    use Helpers;

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

    /**
     * @param $filename
     * @SWG\Info(title="API", version="1.0")
     */
    public function getSwagger($filename='apidoc'){
        $Controllers_dir=__DIR__.'/';
        $OutPut_dir=__DIR__.'/../../../public/swagger-ui/json/';
        $swagger=\Swagger\scan($Controllers_dir);
        $file=fopen($OutPut_dir.$filename.'.json',"w");
        fwrite($file,urldecode(json_encode($swagger)));
        fclose($file);
    }
}
