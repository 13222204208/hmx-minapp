<?php

namespace App\Http\Controllers\Minapp;

use App\Models\User;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try { 
            $validator = Validator::make(//验证数据字段
                $request->all(),
                [
                    'code' => 'required',
                    'nickname' => 'required',
                    'avatar' => 'required',
                    //'iv' => 'required',
                    //'encryptedData' => 'required'
                ],
                [
                    'required' => ':attribute不能为空',
                ],
                [
                    'code' => '微信code',
                    'nickname' =>'昵称',
                    'avatar' => '头像'
                ]        
            );
            
            if ($validator->fails()) {
                $messages = $validator->errors()->first();
                return $this->failed($messages);
            }

            $code = $request->code;

            $config = [
                'app_id' => env('WECHAT_MINI_PROGRAM_APPID'),
                'secret' => env('WECHAT_MINI_PROGRAM_SECRET'),
            ];
            // 根据 code 获取微信 openid 和 session_key
            $miniProgram = Factory::miniProgram($config); 
            $data = $miniProgram->auth->session($code);
           
            if (isset($data['errcode'])) {
                return $this->failed('已过期或不正确');
            } 

         
            $phone="";
            if($request->has("iv")){
                $iv = $request->iv;
                $encryptedData = $request->encryptedData;
                $decryptedData = $miniProgram->encryptor->decryptData($data['session_key'], $iv, $encryptedData);

                if(isset($decryptedData['phoneNumber'])){
                    $phone = $decryptedData['phoneNumber'];
                }
            }

            $user= User::where('wx_id',$data['openid'])->first();
            if($user){
                $vali= [
                    'username'=>$user->username,
                    'password'=> 'kd123456'
                ];
                if (! $token = auth('api')->attempt($vali)) {
                    return  $this->failed('生成token错误');
                }
                $all['userinfo']= $user;
                $all['token']= $token;   
            
                return $this->success($all);
            }else{
                $newUser= new User();
                $newUser->wx_id= $data['openid'];
                $newUser->wx_session_key= $data['session_key'];
                $newUser->username= $data['openid'];
                $newUser->phone= $phone;
                $newUser->password= Hash::make('kd123456');
                $newUser->nickname= $request->nickname;
                $newUser->avatar= $request->avatar;
                $newUser->save();

                $vali= [
                    'username'=>$newUser->username,
                    'password'=> 'hmx123456'
                ];
                if (! $token = auth('api')->attempt($vali)) {
                    return  $this->failed('生成token错误');
                }
                $all['userinfo']= $newUser;
                $all['token']= $token;
                return $this->success($all);
            }

        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
