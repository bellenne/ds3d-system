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
                
                @include("header")

                <div class="container-fluid">
                    <h3 class="text-center">Автоматическая генерация наклеек под плоттер</h3>
                    
                    <a href="download?type=jpeg&filename={{$filename}}" target="_blank" class="d-block">Скачать наклейки</a>
                    <a href="download?type=svg&filename={{$filename}}" target="_blank" class="d-block">Скачать контуры</a>
                    
                </div>

            </div>
        </div>
    </div>
    @include("footer")