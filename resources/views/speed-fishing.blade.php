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
                                <div id="speedGameContainer">
                                    <div id="scoreDisplay">Score: 0</div>
                                    <div class="speed-lane" id="speedLeftLane">
                                        <div id="player" class="fisherman left">🎣</div>
                                    </div>
                                    <div class="speed-lane" id="speedMiddleLane">
                                        <div id="player" class="fisherman middle">🎣</div>
                                    </div>
                                    <div class="speed-lane" id="speedRightLane">
                                        <div id="player" class="fisherman right">🎣</div>
                                    </div>
                                    <input type="text" id="speedFishGameInput" placeholder="Type to fish...">
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
    <script src="{{ asset('js/speed-fishing.js') }}"></script>
@endsection