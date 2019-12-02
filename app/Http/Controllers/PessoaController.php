<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class PessoaController extends Controller
{
    public function Inscreve(Request $request){
        if (session_id() == '') {
            session_start();
        }
        $url = env("API_URL", "http://localhost:3000") . "/participant";
        $client = new Client();
        $participant = [
            "userId" => $_SESSION['user']->id,
            "eventoId" => $request->input('event'),
        ];
        $json = json_encode($participant);
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
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $erro = "Existem dados invalidos na requisicao.";
            $eventos = $_SESSION['eventos'];
            return view('view-evento', compact('eventos'));
        }
    }
}
