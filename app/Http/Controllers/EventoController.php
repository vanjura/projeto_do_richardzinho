<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EventoController extends Controller
{
    public function Index(){
        if (session_id() == '') {
            session_start();
        }
        $url = env("API_URL", "http://localhost:3000") . "/tipoEvento";
        $client = new Client();
        try {
            $options = [
                'headers' => [
                    'content-type' => 'application/json',
                    'token' => $_SESSION['token']
                ]
            ];
            $response = $client->request('GET', $url, $options);
            if ($response->getBody()) {
                $tipos = json_decode($response->getBody());
                $_SESSION['tipos'] = $tipos;
                return view('cadastro-evento', compact('tipos'));
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            return view('home');
        }
    }

    public function Store(Request $request){
        if (session_id() == '') {
            session_start();
        }
        $url = env("API_URL", "http://localhost:3000") . "/event";
        $client = new Client();
        $event = [
            "startDate" => $request->input('startDate') . "T01:00:00.000Z",
            "endDate" => $request->input('endDate') . "T01:00:00.000Z",
            "title" => $request->input('title'),
            "street" => $request->input('street'),
            "neighborhood" => $request->input('neighborhood'),
            "city" => $request->input('city'),
            "referencePoint" => $request->input('referencePoint'),
            "description" => $request->input('description'),
            "eventTypeId" => $request->input('eventTypeId'),
            "ownerId" => $_SESSION['user']->id,
            "status" => true,
        ];
        $json = json_encode($event);
        try {
            $options = [
                'headers' => [
                    'content-type' => 'application/json',
                    'token' => $_SESSION['token']
                ],
                'body' => $json
            ];
            $response = $client->request('POST', $url, $options);
            return view('home');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            $tipos = $_SESSION['tipos'];
            return view('cadastro-evento', compact('tipos', 'erro'));
        }
    }

    public function Show(){
        if (session_id() == '') {
            session_start();
        }
        $url = env("API_URL", "http://localhost:3000") . "/event";
        $client = new Client();
        try {
            $options = [
                'headers' => [
                    'content-type' => 'application/json',
                    'token' => $_SESSION['token']
                ]
            ];
            $response = $client->request('GET', $url, $options);
            if ($response->getBody()) {
                $eventos = json_decode($response->getBody());
                $_SESSION['eventos'] = $eventos;
                return view('view-evento', compact('eventos'));
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            return view('home');
        }
    }

    public function Edita(Request $request){
        // dd("Chegou aqui", $request->all());
        if (session_id() == '') {
            session_start();
        }
        $url = env("API_URL", "http://localhost:3000") . "/event/" . $request->input('event');
        $client = new Client();
        try {
            $options = [
                'headers' => [
                    'content-type' => 'application/json',
                    'token' => $_SESSION['token']
                ]
            ];
            $response = $client->request('GET', $url, $options);
            if ($response->getBody()) {
                $evento = json_decode($response->getBody());
                $_SESSION['evento-edicao'] = $evento;
                $url = env("API_URL", "http://localhost:3000") . "/tipoEvento";
                $client = new Client();
                try {
                    $options = [
                        'headers' => [
                            'content-type' => 'application/json',
                            'token' => $_SESSION['token']
                        ]
                    ];
                    $response = $client->request('GET', $url, $options);
                    if ($response->getBody()) {
                        $tipos = json_decode($response->getBody());
                        return view('edita-evento', compact('evento', 'tipos'));
                    }
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    $erro = "Existem dados invalidos na requisicao.";
                    return view('home');
                }
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            return view('home');
        }

    }

    public function Update(Request $request){
        if (session_id() == '') {
            session_start();
        }
        $event = [
            "id" => $request->input('id'),
            "title" => $request->input('title'),
            "startDate" => $request->input('startDate') . "T01:00:00.000Z",
            "endDate" => $request->input('endDate') . "T01:00:00.000Z",
            "street" => $request->input('street'),
            "neighborhood" => $request->input('neighborhood'),
            "city" => $request->input('city'),
            "referencePoint" => $request->input('referencePoint'),
            "description" => $request->input('description'),
            "eventTypeId" => $request->input('eventTypeId'),
            "status" => true,
        ];
        $url = env("API_URL", "http://localhost:3000") . "/event";
        $client = new Client();
        $json = json_encode($event);
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
                return redirect('viewEvents');
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            return view('home');
        }
    }
}
