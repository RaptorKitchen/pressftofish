@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="game-container" class="cave-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 89vh;">
            <div class="text-center">
                <div class="row mt-5" id="location-title-container">
                    <div class="col-12">
                        <div id="location-title" class="location-title">
                            <h1>The Cave</h1>
                        </div>
                    </div>
                </div>
                <div id="elderFish" class="text-center">
                    <img src="./images/elder-fish.png" class="w-50 mt-5 pt-5"/>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="input-container cave-input">
                            <input type="text" id="game-input" placeholder="What to do..." autocomplete="off">
                            <span class="enter-icon">&#8629;</span>
                        </div>
                    </div>
                </div>
                <div class="shard-container">
                    <div class="shard-slice shard-left deg-minus-45"></div>
                    <div class="shard-slice shard-center"></div>
                    <div class="shard-slice shard-right deg-45"></div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div id="dialogue-container" class="cave-dialogue-container">
                            <div class="row">
                                <div class="col-4">
                                    <p id="leftChoiceLabel" class="choice-label floats"></p>
                                </div>
                                <div class="col-4">
                                    <p id="centerChoiceLabel" class="choice-label floats"></p>
                                </div>
                                <div class="col-4">
                                    <p id="rightChoiceLabel" class="choice-label floats"></p>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/game.js') }}"></script>
@endsection
