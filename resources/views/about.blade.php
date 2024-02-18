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
    <body class="antialiased">
        <div id="about-container">
            <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="text-center">
                    <div class="row">
                        <div class="col-12">
                            <img src="./images/pftf-logo.png" class="m-2 text-center img-responsive" width="350"/>
                        </div>
                    </div>
                    <div id="about-text-container">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="mb-2">About this project</h1>
                                <p>This web experiment is a class project for Oakland Community College's HTML class.</p>
                                <p>It is designed by Andrew Lerma, using art generated by Chat GPT-4's Dall-E 3 AI image generator, some of which was further modified by Andrew Lerma.</p>
                                <div class="row">
                                    <div class="col-6">
                                        <ul style="list-style: none">Sounds:</ul>
                                            <li>Nature sounds - something on motion array</li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul style="list-style: none">
                                            <li>Fonts:<li>
                                            <li><a href="https://fonts.google.com/share?selection.family=Amarante" target="_blank">Amarante</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <hr />
                                <p>This is a Laravel project made using a combination of HTML, CSS, Javascript, PHP, and additional technologies.</p>
                                <p>Please feel free to share your thoughts with Andrew here: <a href="https://twitter.com/@raptorkitchen" target="_blank">@raptorkitchen</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/game.js') }}"></script>
    </body>
</html>
