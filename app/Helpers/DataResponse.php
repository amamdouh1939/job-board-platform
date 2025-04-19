<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class DataResponse
{

    protected static $data;

    protected static $meta;

    protected static int $status = 200;

    protected static string $message = 'Success';

    public static function data($data)
    {
        self::$data = $data;
        return new static();
    }

    public static function meta($meta)
    {
        self::$meta = $meta;
        return new static();
    }

    public static function status(int $status = 200)
    {
        self::$status = $status;
        return new static();
    }

    public static function message(string $message = 'Success')
    {
        self::$message = $message;
        return new static();
    }

    public static function create(): JsonResponse
    {
        return response()->json([
            'status' => self::$status,
            'message' => self::$message,
            'data' => self::$data,
            'meta' => self::$meta,
        ], self::$status);
    }
}
