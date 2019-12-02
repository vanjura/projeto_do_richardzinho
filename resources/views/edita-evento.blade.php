<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Editar Evento</title>

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
                        Editar Evento
                    </div>
                    <span style="font-size: 30px; color:red">
                    <?php if(isset($erro)){echo($erro);} ?>
                    </span>
                    <form method="post" action="/editaEvent">
                        <?php echo csrf_field() ?>
                        <div align="center">
                            <input type="hidden" name="id" value="{{$evento->id}}">
                            <div class="form-group">
                                <span style="font-size: 30px">Data de Início</span>
                                <input class="form-control form-control-lg" type="datetime-local" data-date="" data-date-format="yyyy-MM-ddThh:mm" id="startDate" name="startDate" value="<?= substr($evento->startDate, 0 , 16)?>">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Data de Término</span>
                                <input class="form-control form-control-lg" type="datetime-local" data-date="" data-date-format="YYYY-MM-DD" id="endDate" name="endDate" value="<?= substr($evento->endDate, 0 , 16)?>">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Título do evento</span>
                                <input class="form-control form-control-lg" type="text" placeholder="{{$evento->title}}" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Rua</span>
                                <input class="form-control form-control-lg" type="text" placeholder="{{$evento->street}}" name="street" id="street">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Bairro</span>
                                <input class="form-control form-control-lg" type="text" placeholder="{{$evento->neighborhood}}" name="neighborhood" id="neighborhood">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Cidade</span>
                                <input class="form-control form-control-lg" type="text" placeholder="{{$evento->city}}" name="city" id="city">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Ponto de Referência</span>
                                <input class="form-control form-control-lg" type="text" placeholder="{{$evento->referencePoint}}" name="referencePoint" id="referencePoint">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Descrição do evento</span>
                                <input class="form-control form-control-lg" type="text" placeholder="{{$evento->description}}" name="description" id="description">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Tipo do evento</span>
                                <select class="form-control form-control-lg" name="eventTypeId">
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{$tipo->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Cancelado</span>
                                <select class="form-control form-control-lg" name="status">
                                    <option value="true">Não</option> 
                                    <option value="false">Sim</option> 
                                </select>
                            </div>
                        </div>
                        <br>
                        <div align="center">
                            <button type="submit" class="btn btn-outline-success">Salvar</button>
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