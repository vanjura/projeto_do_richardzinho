<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Evento</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="title">
                        Detalhes Evento {{$evento->id}}
                    </div>
                    <span style="font-size: 30px; color:red">
                    <?php if(isset($erro)){echo($erro);} ?>
                    </span>
                        <?php echo csrf_field() ?>
                        <div align="center">
                                <span style="font-size: 30px"><strong>Título do evento:</strong>{{$evento->title}}</span><br>
                                <span style="font-size: 30px"><strong>Data de Início:</strong>{{$evento->startDate}}</span><br>
                                <span style="font-size: 30px"><strong>Data de Término:</strong>{{$evento->endDate}}</span><br>
                                <span style="font-size: 30px"><strong>Rua:</strong>{{$evento->street}}</span><br>
                                <span style="font-size: 30px"><strong>Bairro:</strong>{{$evento->neighborhood}}</span><br>
                                <span style="font-size: 30px"><strong>Cidade:</strong>{{$evento->city}}</span><br>
                                <span style="font-size: 30px"><strong>Ponto de Referência:</strong>{{$evento->referencePoint}}</span><br>
                                <span style="font-size: 30px"><strong>Descrição do evento:</strong>{{$evento->description}}</span><br>
                                <span style="font-size: 30px"><strong>Tipo do evento:</strong>{{$evento->eventType->name}}</span><br>
                                <span style="font-size: 30px"><strong>Criador do evento:</strong>{{$evento->user->username}}</span><br><br>
                        </div>
                        <br>
                        <div align="center">
                        <div class="title">
                            Comentários
                        </div>
                        <table class="table">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Criador</th>
                            <th scope="col">Comentário</th>
                            <th scope="col">Data</th>
                        </tr>
                        @foreach($eventos as $evento)
                            <tr>
                                <td>{{$message->id}}</td>
                                <td>{{$message->username}}</td>
                                <td>{{$message->message}}</td>
                                <td>{{explode("T",$message->messageDate)[0]}}</td>                             
                            </tr>
                        @endforeach
                    </table>
                        </div>
                        <br>
                        <div class="title">
                            Adicione seu comentário:
                        </div>
                        <form method="post" action="/mensagem">
                        <input class="form-control form-control-lg" type="textarea" placeholder="Insira seu comentário aqui" id="message" name="message">
                        </form>
                        <div align="center">
                            <a href="/home">
                                <p>Voltar</p>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</body>



</html>