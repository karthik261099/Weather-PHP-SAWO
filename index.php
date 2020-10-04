<?php

if(array_key_exists("btn", $_GET) AND $_GET["lat"]!=0 AND $_GET["long"]!=0){

    $API_KEY="a092e5f4151bd55bbf7ee6a9a081d935";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/weather?lat=".$_GET["lat"]."&lon=".$_GET["long"]."&appid=".$API_KEY);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = json_decode(curl_exec($ch),true);

    $country=$response["sys"]["country"];
    $division=$response["name"];
    $latitude=number_format((float)$_GET["lat"], 2, '.', '');
    $longitude=number_format((float)$_GET["long"], 2, '.', '');
    $temperature=$response["main"]["temp"];
    $pressure=$response["main"]["pressure"];
    $humidity=$response["main"]["humidity"];

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SAWO</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

    </head>

    <body id="page-top">

        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">SAWO WEATHER</a>
            </div>
        </nav>

        <header class="masthead bg-primary text-white text-center" style="padding: 30px;">
            <div class="container d-flex align-items-center flex-column" style="height: 100vh;">

                <h1 class="masthead-heading text-uppercase mb-0" >Feeling hot?</h1>

                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <form method="GET">
                    <input type="hidden" id="lat" name="lat" value="0">
                    <input type="hidden" id="long" name="long" value="0">
                    <button name="btn" value="clicked" class="btn btn-success btn-lg">
                        <b>CHECK WEATHER!</b>
                    </button>
                </form>

                <br>

                <?php

                    if(array_key_exists("btn", $_GET)){

                        if($_GET["lat"]!=0 AND $_GET["long"]!=0){
                            echo "
                            <h3>Country : ".$country."</h3>
                            <h3>Division : ".$division."</h3>
                            <h3>Latitude : ".$latitude."</h3>
                            <h3>Longitude : ".$longitude."</h3>
                            <h3>Temperature (C) : ".($temperature-273.15)." ℃</h3>
                            <h3>Temperature (K) : ".$temperature."K</h3>
                            <h3>Pressure : ".$pressure."</h3>
                            <h3>Humidity : ".$humidity."</h3>

                            ";
                        }else{
                            echo "<h1>Please allow location access!</h1>";
                        }
                        
                    }

                ?>
                
            </div>
        </header>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script>

            getLocation();

            function getLocation() {
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              }
            }

            function showPosition(position) {
              $("#lat").val(position.coords.latitude);
              $("#long").val(position.coords.longitude);
            }

        </script>
    </body>
</html>
