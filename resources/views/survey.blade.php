@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="survey-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center">                
                <h1 class="animate-text amarante-regular remove-on-press"></h1>
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
                    <input type="text" id="inputField" class="w-50 m-auto mb-3 sway-input" style="border: 2px solid darkgrey" autofocus>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/survey.js') }}"></script>
@endsection