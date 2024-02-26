@extends('layouts.layout')
@section('body')
        <div class="gradient-background">
            <div class="content-container">
                <video id="webcam" autoplay hidden></video>
                <canvas id="canvas" width="640" height="480"></canvas>
            </div>
        </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/mirror.js') }}"></script>
@endsection
