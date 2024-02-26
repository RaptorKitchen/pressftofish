@extends('layouts.layout')
@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection
@section('body')
    <div class="fishing-background">
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
                                    <div id="fisher" class="d-none"></div>
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
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/fish.js') }}"></script>
@endsection