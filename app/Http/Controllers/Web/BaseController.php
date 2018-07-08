<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function __construct(){

    }

    protected function success($data = [])
    {
        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => config('webcode.code')[200],
            'data'    => $data,
        ]);
    }

    protected function fail($code, $data = [])
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'message' => config('webcode.code')[(int) $code],
            'data'    => $data,
        ]);
    }
}
