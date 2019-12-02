<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    //
    function Login()
    {
        if (!empty($_POST)) {
            $json = json_encode($_POST);
            $client = new Client();
            $url = env("API_URL", "http://localhost:3000") . "/user/login";
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
                    if (session_id() == '') {
                        session_start();
                    }
                    $_SESSION['senha'] = $_POST['password'];
                    $_SESSION['token'] = $body->token;
                    $_SESSION['user'] = $body->user;
                    // return view('dashboard', compact('body'));
                    return redirect('/home');
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $erro = "Existem dados invalidos na requisicao.";
                return view('login', compact('erro'));
            }
        } else {
            $erro = "Voce deve preencher os itens para continuar.";
            return view('login', compact('erro'));
        }
    }

    function Register()
    {
        if (!empty($_POST)) {
            $_POST['birthdate'] = $_POST['birthdate'] . "T01:00:00.000Z";
            $json = json_encode($_POST);
            $client = new Client();
            $url = env("API_URL", "http://localhost:3000") . "/user";
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
                    if (session_id() == '') {
                        session_start();
                    }
                    // $_SESSION['user'] = $body->user;
                    // return view('dashboard', compact('body');
                    
                    return redirect('/login');
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $erro = "Existem dados invalidos na requisicao.";
                return view('register', compact('erro'));
            }
        } else {
            $erro = "Você deve preencher os itens para continuar.";
            return view('register', compact('erro'));
        }
    }

    function Edit()
    {
        $id = request()->route('id');
        if (!empty($_POST)) {
            $_POST['id'] = $id;
            if (session_id() == '') {
                session_start();
            }
            if ($_POST['username'] == '') {
                $_POST['username'] = $_SESSION['user']->username;
            }
            if ($_POST['birthdate'] == '') {
                $_POST['birthdate'] = $_SESSION['user']->birthdate . "T01:00:00.000Z";
            } else {
                $_POST['birthdate'] = $_POST['birthdate'] . "T01:00:00.000Z";
            }
            if ($_POST['sex'] == '') {
                $_POST['sex'] = $_SESSION['user']->sex;
            }
            if ($_POST['email'] == '') {
                $_POST['email'] = $_SESSION['user']->email;
            }
            if ($_POST['password'] == '') {
                $_POST['password'] = $_SESSION['senha'];
            }

            $json = json_encode($_POST);
            $client = new Client();
            $url = env("API_URL", "http://localhost:3000") . "/user";
            try {
                $options = [
                    'headers' => [
                        'content-type' => 'application/json',
                        'token' => $_SESSION['token']
                    ],
                    'body' => $json
                ];
                $response = $client->request('PUT', $url, $options);
                if ($response->getBody()) {
                    $body = json_decode($response->getBody());
                    if (session_id() == '') {
                        session_start();
                    }
                    $_SESSION['user'] = $body;
                    return redirect('/home');
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                dd($e);
                $erro = "Existem dados invalidos na requisicao.";
                return view('user-edit', compact('erro'));
            }
        } else {
            $erro = "Você deve preencher os itens para continuar.";
            return view('user-edit', compact('erro'));
        }
    }

    function Delete()
    {
        if (session_id() == '') {
            session_start();
        }
        $id = request()->route('id');
        $client = new Client();
        $url = env("API_URL", "http://localhost:3000") . "/user/" . $id;
        try {
            $options = [
                'headers' => [
                    'content-type' => 'application/json',
                    'token' => $_SESSION['token']
                ]
            ];
            $response = $client->request('DELETE', $url, $options);
            if ($response->getBody()) {
                $body = json_decode($response->getBody());
                if (session_id() == '') {
                    session_start();
                }
                return redirect('/');
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
            $erro = "Existem dados invalidos na requisicao.";
            return view('home', compact('erro'));
        }
    }
}
