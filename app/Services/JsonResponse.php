<?php


namespace App\Services;


class JsonResponse
{
    /**
     * Return a new response from the application.
     *
     * @param  string  $msg
     * @param  object  $data
     * @param  int     $code
     * @param  array   $args 关联数组，用于返回信息内添加自定义内容 ['key1'=>'value1',.....]
     */
    static public function success($msg = '', $data = null, $code = 0,...$args)
    {
        $response = [
            'msg' => $msg,
            'status' => true,
            'data' => $data??new \stdClass(),
            'code' => $code,
        ];

        if (is_array($args)){
            foreach (array_collapse($args) as $key => $value){
                $response[$key] = $value;
            }
        }
        return response()->json($response);
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
