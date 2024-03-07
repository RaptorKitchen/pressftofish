@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="about-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="./images/pftf-logo.png" class="m-2 text-center img-responsive" width="350"/>
                </div>
                <div class="about-text-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h1 class="mb-2">About this project</h1>
                                <p>This web experiment is a class project for Oakland Community College's HTML class.</p>
                                <p>It is designed by Andrew Lerma, using art generated by Chat GPT-4's Dall-E 3 AI image generator, some of which was further modified by Andrew Lerma.</p>
                            </div>
                            <div class="row">
                                <div class="col-4 text-left">
                                    <ul style="list-style: none" class="text-left">Sounds:</ul>
                                        <li class="ml-2">Nature sounds - something on motion array</li>
                                    </ul>
                                </div>
                                <div class="col-4 text-left">
                                    <ul style="list-style: none">
                                        <li>Fonts:<li>
                                        <li><a href="https://fonts.google.com/share?selection.family=Amarante" target="_blank">Amarante</a></li>
                                    </ul>
                                </div>
                                <div class="col-4 text-left">
                                    <ul style="list-style: none">Misc:</ul>
                                        <li>Regal Subtle Pattern backgorund (modified) from <a href="https://www.toptal.com/designers/subtlepatterns/regal/" target="_blank">Toptal</a></li>
                                    </ul>
                                </div>
                            </div>
                            <p class="mt-5">This is a Laravel project made using a combination of HTML, CSS, Javascript, jQuery, PHP, and additional technologies.</p>
                            <p class="mt-5">Please feel free to share your thoughts here: <a href="https://twitter.com/@raptorkitchen" target="_blank">@raptorkitchen</a></p>
                            <p class="mt-5">To learn more about Andrew, <a href="{{route('about_me')}}">click here</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
