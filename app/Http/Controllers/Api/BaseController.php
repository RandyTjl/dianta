<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BaseController extends Controller
{

    public function __construct(){
        $request = new Request();
        $apiToken = $request->header('apiToken');
        $user = User::where('api_token',$apiToken)->first();
        if(empty($user) || $user->token_expiration < time()){
            return response()->json(['status'  => false, 'code'    => 300002, 'message' => config('apicode.code')[(int) 300002],]);
        }
        $this->user_id = $user->id;
    }

    protected function success($data = [])
    {
        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => config('apicode.code')[200],
            'data'    => $data,
        ]);
    }

    protected function fail($code, $data = [])
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'message' => config('apicode.code')[(int) $code],
            'data'    => $data,
        ]);
    }
}
