<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Press F to Fish - A simple web game by Andrew Lerma</title>

        <!-- Fonts -->
        <!-- https://fonts.google.com/specimen/VT323/about VT323 by Peter Hull -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased fishing-background">
        <div class="gradient-background">
            <div class="content-container">
                <div id="fullPageModal" class="modal diamondBackground">
                    <div class="modal-content">
                        <div class="close"></div>
                        <div class="content-wrapper">
                            <div id="resultText">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-12">
                                <img src="./images/pftf-logo.png" class="m-2 text-center img-responsive" width="150"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div id="fishArea">
                                    <div id="fisher"></div>
                                    <div id="line"></div>
                                    <img src="/images/lure.png" id="lure" class="lure">
                                    <div class="fish" style="top: 300px; left: 200px;"></div>
                                    <div class="fish" style="top: 250px; left: 400px;"></div>
                                    <div class="fish" style="top: 450px; left: 600px;"></div>
                                    <div class="rock" style="top: 200px; left: 100px;"></div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="fishing-bottom-panel"></div>
            </div>
        </div>
        <script src="{{ asset('js/fish.js') }}"></script>
    </body>
</html>