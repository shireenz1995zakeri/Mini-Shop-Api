<?php

namespace App\Services\Sms\MeliPayamak;

use App\Services\Factory\SmsFactory;
use App\Services\Sms\Sms;
use Exception;
use Melipayamak\MelipayamakApi;

class MeliPayamak extends Sms implements SmsFactory
{
    const From = '50004001241909';
    public function send($request)
    {
        try{
            $api = new MelipayamakApi($request['username'],$request['password']);
            $sms = $api->sms();
            $response = $sms->send($request['to'],self::From,$request['text']);
            $json = json_decode($response);
            if (isset($json->Value) && !empty($json->Value)){
                return [
                    'status' => true,
                    'response' => $json
                ];
            }
            else{
                return [
                    'status' => false,
                    'response' => $json
                ];
            }
        }
        catch(Exception $e){
            return [
                'status' => false,
                'response' => $e->getMessage()
            ];
        }
    }
}
