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
            if ($response->getBody()) {
                dd($response->getBody());
                return view('home');
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            return view('cadastro-evento');
        }
    }
}
