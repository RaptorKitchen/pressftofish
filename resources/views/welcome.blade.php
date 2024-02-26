@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="background-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center">
                <div id="game-container">
                    <div class="row">
                        <div class="col-12">
                            <img src="./images/pftf-logo.png" class="text-center img-responsive" width="350" style="margin-top: -35%; margin-bottom: 150px"/>
                        </div>
                    </div>
                    <h1 class="animate-text amarante-regular" data-key-param='{"s":"start"}'>Press S to Start</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <p><a class="gray-link" href="{{ route('about') }}" target="_blank">About</a></p>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/game.js') }}"></script>
@endsection