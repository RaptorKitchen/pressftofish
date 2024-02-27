@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="survey-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center">
                <div id="game-container">
                    <h1 class="animate-text amarante-regular" data-key-param='{"s":"start"}'>Type "done" when finished</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="survey">
                <input type="text" id="inputField" class="w-50 m-auto mb-3" autofocus>
                <div id="message"></div>
                <div id="apple" class="d-none">Apple</div>
                <div id="banana" class="d-none">Banana</div>
                <div id="cherry" class="d-none">Cherry</div>
                <!-- more elements here -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/survey.js') }}"></script>
@endsection