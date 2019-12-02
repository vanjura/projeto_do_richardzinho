<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eventos</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="row">
            <div class=col-md-12 align="center">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="title">
                        Listagem de eventos
                    </div>
                    <a href="/home">
                                <p>Voltar</p>
                            </a>
                    <table class="table">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Criador</th>
                            <th scope="col">Data de Início</th>
                            <th scope="col">Data de Término</th>
                            <th scope="col">Pessoas inscritas</th>
                            <th scope="col" colspan="1  ">Opções</th>
                        </tr>
                        @foreach($eventos as $evento)
                        @php   
                            $participa = false
                        @endphp
                        @foreach($evento->participant as $participant)
                            @if($participant->username == $_SESSION['user']->username)
                                @php   
                                    $participa = true
                                @endphp
                            @endif
                        @endforeach
                        @if($evento->status == 0)
                            <tr class="table-danger">
                        @elseif($participa)
                            <tr class="table-success">
                        @else
                            <tr>
                        @endif
                                <td>{{$evento->id}}</td>
                                <td>{{$evento->title}}</td>
                                <td>{{$evento->user->username}}</td>
                                <td>{{explode("T",$evento->startDate)[0]}}</td>
                                <td>{{explode("T",$evento->endDate)[0]}}</td>
                                <td>{{sizeof($evento->participant)}}</td>
                                @if($evento->status == 1)
                                    @if($_SESSION['user']->id == $evento->user->id)
                                        <td>
                                            <a title="Editar" href="{{ route('evento.edita', ['event' => $evento->id]) }}"><i class="fa fa-edit" style="font-size:20px;color:yellow;padding:1px"></i></a>
                                            <!-- <a title="Excluir" href="{{ route('evento.edita', ['event' => $evento->id]) }}"><i class="fa fa-trash" style="font-size:20px;color:red;padding:1px"></i></a> -->
                                            <!-- <a title="Cancelar" href="{{ route('evento.edita', ['event' => $evento->id]) }}"><i class="fa fa-ban" style="font-size:20px;color:grey;padding:1px"></i></a> -->
                                            <!-- <a title="Detalhes" href="/evento/{{$evento->id}}"><i class="fa fa-search" style="font-size:20px;color:blue;"></i></a> -->
                                        </td>
                                    @else
                                        <td>
                                            
                                            @if($evento->status == 0)
                                                Cancelado
                                            @elseif($participa)
                                                Inscrito 
                                                <!-- <a title="Detalhes" href="/evento/{{$evento->id}}"><i class="fa fa-search" style="font-size:20px;color:blue;padding:1px"></i></a> -->
                                            @else
                                                <a title="Increver-se" href="{{ route('participant.inscreve', ['event' => $evento->id]) }}"><i class="fa fa-check" style="font-size:25px;color:green;padding:1px"></i></a>
                                                <!-- <a title="Detalhes" href="/evento/{{$evento->id}}"><i class="fa fa-search" style="font-size:20px;color:blue;padding:1px"></i></a> -->
                                            @endif
                                        </td>
                                    @endif
                                @else
                                    <td></td>
                                @endif
                                
                            </tr>
                        @endforeach
                    </table>  
                </div>
                <div class="col-md-1"></div>
            </div>
</body>



</html>