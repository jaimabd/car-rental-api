<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public static function success($code,$message,$data){

        $response =  array();

        $response['code'] = $code;
        $response['message'] = $message;
        $response['data'] = $data;

        return json_encode($response);

    }

    public static function failure($code, $message){
        $response =  array();

        $response['code'] = $code;
        $response['message'] = $message;
        //$response['data'] = $data;

        return json_encode($response);

    }
}
