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
                                    <div id="line">
                                        <div id="hook1" class="fishing-hook">🪝</div>
                                        <div id="hook2" class="fishing-hook">🪝</div>
                                    </div>
                                    
                                    <img src="/images/lure.png" id="lure" class="lure d-none">
                                    <div class="fish" style="top: 300px; left: 200px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="50" viewBox="0 0 100 50">
                                            <path d="M2,25c0,0,22-23,48-23s38,15,38,23s-10,23-38,23S2,25,2,25z" fill="#222"/>
                                            <text x="40" y="30" font-family="Arial" font-size="12" fill="#fff">?</text>
                                            <path d="M85,25l15-10v20L85,25z" fill="#222"/>
                                        </svg>
                                    </div>
                                    <div class="fish" style="top: 250px; left: 400px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="50" viewBox="0 0 100 50">
                                            <path d="M2,25c0,0,22-23,48-23s38,15,38,23s-10,23-38,23S2,25,2,25z" fill="#222"/>
                                            <text x="40" y="30" font-family="Arial" font-size="12" fill="#fff">?</text>
                                            <path d="M85,25l15-10v20L85,25z" fill="#222"/>
                                        </svg>
                                    </div>
                                    <div class="fish big-fish" style="top: 450px; left: 600px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="50" viewBox="0 0 100 50">
                                            <path d="M2,25c0,0,22-23,48-23s38,15,38,23s-10,23-38,23S2,25,2,25z" fill="#222"/>
                                            <text x="40" y="30" font-family="Arial" font-size="12" fill="#fff">?</text>
                                            <path d="M85,25l15-10v20L85,25z" fill="#222"/>
                                        </svg>
                                    </div>
                                    <div class="fish" style="top: 500px; right: 100px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="50" viewBox="0 0 100 50">
                                            <path d="M2,25c0,0,22-23,48-23s38,15,38,23s-10,23-38,23S2,25,2,25z" fill="#222"/>
                                            <text x="40" y="30" font-family="Arial" font-size="12" fill="#fff">?</text>
                                            <path d="M85,25l15-10v20L85,25z" fill="#222"/>
                                        </svg>
                                    </div>
                                    <div class="rock" style="top: 200px; left: 100px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="40" viewBox="0 0 60 40">
                                            <path d="M2,20c0,0,10-15,28-15s20,10,20,15s-10,15-20,15S2,20,2,20z" fill="#808080"/>
                                            <path d="M10,17c0,0,3-2,5-2s4,1,4,3s-1,4-4,4s-5-3-5-3" fill="#A9A9A9"/>
                                        </svg>
                                    </div>
                                    <div class="rock big-rock" style="top: 200px; left: 100px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="80" viewBox="0 0 60 40">
                                            <path d="M5,20c0,0,8-10,23-10s22,7,22,10s-12,10-22,10S5,20,5,20z" fill="#808080"/>
                                            <path d="M15,18c0,0,2-1,3-1s3,1,3,2s-1,3-3,3s-3-2-3-2" fill="#A9A9A9"/>
                                        </svg>
                                    </div>
                                    <div class="rock" style="top: 300px; left: 500px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="40" viewBox="0 0 60 40">
                                            <path d="M2,20c0,0,10-15,28-15s20,10,20,15s-10,15-20,15S2,20,2,20z" fill="#808080"/>
                                            <path d="M10,17c0,0,3-2,5-2s4,1,4,3s-1,4-4,4s-5-3-5-3" fill="#A9A9A9"/>
                                        </svg>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="fishing-bottom-panel text-center mt-4">
                    <p>Instructions: Press [space] to fish. Catch all of the fish to proceed.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/fish.js') }}"></script>
@endsection