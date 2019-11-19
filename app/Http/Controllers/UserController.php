<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function login () {
        if(!empty ($_POST)) {
            $json = json_encode($_POST);
            $user = new GuzzleHttp\Client();
            $url="localhost:3000/user/login";
            $request = $user->post($url, array('content-type' => 'application/json'), array());
            $request->setBody($json);
            $response = $request->send();
            dd($response);
        }
    }
}
