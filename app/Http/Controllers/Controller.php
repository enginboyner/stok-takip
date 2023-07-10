<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function responseMessage($message, $status, $statusCode, $redirect = null)
    {
        if ($status == 'error') {
            $html = "<div class='alert alert-danger alert-dismissible text-center'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h5></i> $message</h5>
    </div>";


        } else {
            $html = "  <div class='alert alert-success alert-dismissible text-center'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h5><i class='icon fas fa-check'></i> $message</h5>

    </div>";
        }
        $html = str_replace('.', '.<br>', $html);
        return response()->json([
            'message' => $html,
            'status' => $status,
            'redirect' => $redirect
        ], $statusCode);

    }
}
