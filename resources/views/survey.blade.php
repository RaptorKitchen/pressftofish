@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="survey-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center">
                <div id="game-container">
                    <h1 class="animate-text amarante-regular d-none">Type "done" when finished</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="survey" class="text-center">
                <div class="row">
                    <div id="responseContainer">
                        <h3 id="message"></h3>
                    </div>
                </div>
                <div class="row">
                    <input type="text" id="inputField" class="w-50 m-auto mb-3" style="border: 2px solid darkgrey" autofocus>
                </div>
                <div class="row">
                    <div id="responseField">
                        <div id="moutain" class="d-none">Mountain</div>
                        <div id="lake" class="d-none">Lake</div>
                        <div id="cave" class="d-none">Cave</div>
                        <div id="trees" class="d-none">Trees</div>
                        <div id="snow" class="d-none">Snow</div>
                        <div id="sand" class="d-none">Sand</div>
                        <div id="beach" class="d-none">Beach</div>
                        <div id="rocks" class="d-none">Rocks</div>
                        <div id="birds" class="d-none">Birds</div>
                        <div id="clouds" class="d-none">Clouds</div>
                        <div id="turtle" class="d-none">Turtle</div>
                        <div id="dolphin" class="d-none">Dolphin</div>
                    </div>
                </div>
                <!-- more elements here -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/survey.js') }}"></script>
@endsection