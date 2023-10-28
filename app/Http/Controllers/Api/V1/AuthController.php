<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Requests\loginWithCodeRequest;
use App\Http\Requests\sendSmsCodeRequest;
use App\Models\SmsConfig;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiBaseController
{
    public function register(AuthRequest $request): JsonResponse
    {
        $request->validated();

        $user = new User([
            'name'     => $request->name,
            'family'   => $request->family,
            'email'    => $request->email,
            'password' => Hash::make($request->newPassword),
        ]);

        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message'     => 'Successfully created user!',
                'accessToken' => $token,
            ], 201);
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }
    public function sendSMSCode(sendSmsCodeRequest $request , User $user)
    {

        $sms_config  = SmsConfig::query()->where('status','enable')->first();
        if ($sms_config){
            $code = rand(100000, 999999);
            $text = ". کد تایید شما $code میباشد";
            $data = [
                'name' => $sms_config->name,
                'username' => $sms_config->username,
                'password' => $sms_config->password,
                'to' => $request->mobile_number,
                'text' => $text,
            ];
            $sms = (new Sms())->send($data);
            User::query()->where('mobile_number',$request->mobile_number)->update([
                "code" => $code,
                "code_at" => Carbon::now()->addMinutes(3),
                "code_res" => json_encode($sms , JSON_UNESCAPED_SLASHES)
            ]);
            return $this->successResponse(message: 'پیامک با موفقیت ارسال شد');
        }
        return $this->successResponse(message: 'پنل پیامکی فعال نیست' );
    }


    public function loginWithCode(loginWithCodeRequest $request)
    {

        $user = User::where('mobile_number', $request->mobile_number)
            ->where('code', $request->sms_code)
            //->where('code_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return $this->successResponse($user,message: "sms code or mobile number is invalid!");
        }
        // dd(10);
        $user->access_token = $user->createAccessToken();
        return $this->successResponse(  $user->access_token , message: 'User Login Successfully');
    }

    public function logout(Request $request)
    {

            $user = auth()->user()->tokens()->delete();
            return $this->successResponse($user, 'user logged out');

    }
}
