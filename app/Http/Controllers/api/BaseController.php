<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class BaseController extends Controller
{

    public function __construct(){

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
