<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset("css/all.min.css") }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset("css/sb-admin-2.min.css") }}" rel="stylesheet">

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        
        @include("sidebar")
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <!-- Main Content -->
            <div id="content">
                
                <div class="container-fluid">
                    @include("header")
                    <h3 class="text-center">Автоматическая генерация наклеек под плоттер</h3>
                    
                    <a href="https://docs.google.com/spreadsheets/d/1_vTI-7xW9TeSKZi48UqsRndlprajOzp741YjStc29n8/edit?gid=0#gid=0" target="_blank" class="d-block mt-2">Шаблон таблицы для загрузки артикулов</a>
                    <a href="{{route("addStickers")}}" class="d-block mt-2">Загрузить наклейки на сервер</a>
                    
                    <form action="/stickers/generate" method="GET" class="mt-5">
                        <div class="mb-3">
                            <label for="sheets_id" class="form-label">ID таблицы с артикулами</label>
                            <input type="text" name="sheets_id"  class="form-control" placeholder="Пример: 1_vTI-7xW9TeSKZi48UqsRndlprajOzp741YjStc29n8">
                        </div>
                        <div class="mb-3">
                            <label for="range" class="form-label">Диапазон с названием листа</label>
                            <input type="text" name="range"  class="form-control" placeholder="Пример: Артикулы!A2:B" value="Артикулы!A2:B">
                        </div>
                        <button type="submit" class="btn btn-primary">Сгенерировать</button>
                    </form>
                    
                </div>

            </div>
        </div>
    </div>
    @include("footer")