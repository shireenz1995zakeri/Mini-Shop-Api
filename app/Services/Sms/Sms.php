<?php

namespace App\Services\Sms;

use App\Services\Sms\MeliPayamak\MeliPayamak;
use App\Services\traits\FunHelper;

class Sms
{
    use FunHelper;

    public function send($request)
    {
        if (isset($request['name']) && !empty($request['name'])){
            $class_name = 'App\Services\Sms\\'.$request['name']."\\".$request['name'];
            if (class_exists($class_name)){
                 $result = (new $class_name())->send($request);
                 return $result;
            }
        }
        return false;
    }
}
