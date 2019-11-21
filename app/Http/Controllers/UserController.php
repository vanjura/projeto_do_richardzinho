<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    //
    function Login () {
        if(!empty ($_POST)) {
            $json = json_encode($_POST);
            $client = new Client();
            $url="http://localhost:3000/user/login";
            try {
                $options = [
                    'headers' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => $json
                ];
                $response = $client->request('POST', $url, $options);
                if ($response->getBody()) {
                    $body = json_decode($response->getBody());
                    session_start();
                    $_SESSION['token'] = $body->token;
                    $_SESSION['user'] = $body->user;
                    // return view('dashboard', compact('body'));
                    return redirect('/home');
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $erro = "Existem dados invalidos na requisicao.";
                return view('login', compact('erro'));
            }
        }else{
            $erro = "Você deve preencher os itens para continuar.";
            return view('login', compact('erro'));
        }
    }

    function Register () {
        if(!empty ($_POST)) {
            $json = json_encode($_POST);
            $client = new Client();
            $url="http://localhost:3000/user";
            try {
                $options = [
                    'headers' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => $json
                ];
                $response = $client->request('POST', $url, $options);
                if ($response->getBody()) {
                    $body = json_decode($response->getBody());
                    session_start();
                    dd($body,$response->getBody());
                    $_SESSION['user'] = $body->user;
                    // return view('dashboard', compact('body'));
                    return redirect('/home');
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $erro = "Existem dados invalidos na requisicao.";
                return view('register', compact('erro'));
            }
        }else{
            $erro = "Você deve preencher os itens para continuar.";
            return view('register', compact('erro'));
        }
    }
}
