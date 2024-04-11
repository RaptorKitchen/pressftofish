@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="game-container" class="cave-container">
        <div id="fullPageDarken"></div>
        <div id="fullPageModal" style="display:none">
            <div id="wordFindContainer">
                <div id="wordList">
                    <div id="wordTimer">Time left: <span id="time">60</span> seconds</div>
                </div>
                <div id="wordfindGridContainer"></div>
                <div id="wordFindInputContainer">
                    <input type="text" id="wordFindInput" />
                </div>
            </div>
            <div class="modal-content">
                <div class="close"></div>
                <div class="content-wrapper">
                    <div id="resultText"></div>
                </div>
            </div>
        </div>
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
                    <img src="./images/elder-fish.png" class="w-50 mt-5 pt-5" style="max-width: 350px"/>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="input-container cave-input">
                            <input type="hidden" id="round" value="1" />
                            <input type="text" id="cave-input" placeholder="What to do..." autocomplete="off">
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
                        <div id="caveDialogueContainer" class="cave-dialogue-container">
                            <div class="row" id="additionalText"></div>
                            <div class="row" id="elderFishDialogueContainer">
                                <div class="col-12">
                                    <p id="elderFishDialogue" class="choice-label"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p id="leftChoiceLabel" class="choice-label cave-choice floats"></p>
                                </div>
                                <div class="col-4">
                                    <p id="centerChoiceLabel" class="choice-label cave-choice floats"></p>
                                </div>
                                <div class="col-4">
                                    <p id="rightChoiceLabel" class="choice-label cave-choice floats"></p>    
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
<script src="{{ asset('js/wordfind.js') }}"></script>
<script src="{{ asset('js/game.js') }}"></script>
@endsection
