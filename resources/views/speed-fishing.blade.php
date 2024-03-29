@extends('layouts.layout')
@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection
@section('body')
    <div class="fishing-background">
        <div class="speed-background">
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
                        <div class="col-5"></div>
                        <div class="col-2">
                            <div id="scoreDisplay" class="text-center">Score: 0</div>
                        </div>
                        <div class="col-5"></div>
                        <div id="speedFisherContainer" class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div id="fisherman_left" class="fisherman left mt-4 fs-3 jiggle">🎣</div>
                                </div>
                                <div class="col-4">
                                    <div id="fisherman_middle" class="fisherman middle mt-4 fs-3 jiggle" style="display: block">🎣</div>
                                </div>
                                <div class="col-4">
                                    <div id="fisherman_right" class="fisherman right mt-4 fs-3 jiggle">🎣</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div id="speedGameContainer">
                                    <div class="speed-lane" id="speedLeftLane">
                                    </div>
                                    <div class="speed-lane active-lane" id="speedMiddleLane">
                                    </div>
                                    <div class="speed-lane" id="speedRightLane">
                                    </div>
                                    <input type="text" id="speedFishGameInput" placeholder="Type to fish..." autofocus>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="fishing-bottom-panel">
                    <p class="text-center my-1">Instructions: Type "left" and "right" to change lanes. Type the name of the fishing concept or term to catch it. You can only catch fish in one lane at a time.</p>
                    <p class="text-center">Reach a score of 100 to continue</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/speed-fishing.js') }}"></script>
@endsection