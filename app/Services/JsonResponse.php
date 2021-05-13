<?php


namespace App\Services;


class JsonResponse
{
    static public function success($msg = '', $data = null, $code = 0)
    {
        return response()->json([
            'msg' => $msg,
            'status' => true,
            'data' => $data??new \stdClass(),
            'code' => $code,
        ]);
    }

    static public function fail($msg = '', $data = null, $code = -1)
    {
        return response()->json([
            'msg' => $msg,
            'status'=>false,
            'data' => $data??new \stdClass(),
            'code' => $code
        ]);
    }
}
