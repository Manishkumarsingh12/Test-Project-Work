<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Egulias\EmailValidator\Result\Reason\UnclosedComment;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendresponse($result, $message)
    {
        $response = [
            'status' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function senderror($error, $errormessage = [], $code = 401)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errormessage)) {
            $response['data'] = $errormessage;
        }

        return response()->json($response, $code);
    }
}