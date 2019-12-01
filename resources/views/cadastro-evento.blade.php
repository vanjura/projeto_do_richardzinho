<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

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
                        Registre-se
                    </div>
                    <span style="font-size: 30px; color:red">
                    <?php if(isset($erro)){echo($erro);} ?>
                    </span>
                    <form method="post" action="/registerEvent">
                        <?php echo csrf_field() ?>
                        <div align="center">
                            <div class="form-group">
                                <span style="font-size: 30px">Start Date</span>
                                <input class="form-control form-control-lg" type="date" data-date="" data-date-format="YYYY-MM-DD" id="startDate" name="startDate">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">End Date</span>
                                <input class="form-control form-control-lg" type="date" data-date="" data-date-format="YYYY-MM-DD" id="endDate" name="endDate">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Title</span>
                                <input class="form-control form-control-lg" type="text" placeholder="Title" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Street</span>
                                <input class="form-control form-control-lg" type="text" placeholder="Street" name="street" id="street">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">neighborhood</span>
                                <input class="form-control form-control-lg" type="text" placeholder="neighborhood" name="neighborhood" id="neighborhood">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">city</span>
                                <input class="form-control form-control-lg" type="text" placeholder="city" name="city" id="city">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">referencePoint</span>
                                <input class="form-control form-control-lg" type="text" placeholder="referencePoint" name="referencePoint" id="referencePoint">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">description</span>
                                <input class="form-control form-control-lg" type="text" placeholder="description" name="description" id="description">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 30px">Event Type</span>
                                <select class="form-control form-control-lg" name="eventTypeId">
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{$tipo->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div align="center">
                            <button type="submit" class="btn btn-outline-success">Salvar</button>
                            <a href="/login">
                                <p>Voltar</p>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</body>



</html>