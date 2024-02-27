@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div class="mirror-background">
        <div class="content-container">
            <video id="inputVideo" width="400" height="800" class="d-none">
            </video>
            <canvas id="mirrorCanvas">
            </canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/clmtrackr.js"></script>
    <script src="{{ asset('js/mirror.js') }}"></script>
@endsection
