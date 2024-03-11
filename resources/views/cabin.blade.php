@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="cabin-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 89vh;">
            <div class="text-center">
                <div id="game-container">
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="input-container">
                                <input type="text" id="game-input" placeholder="Type mirror to center yourself...">
                                <span class="enter-icon">&#8629;</span>
                            </div>
                        </div>
                    </div>
                    <div class="shard-container">
                        <div class="shard-slice shard-left deg-minus-45">
                            <p></p>
                        </div>
                        <div class="shard-slice shard-center">
                            <p></p>
                        </div>
                        <div class="shard-slice shard-right deg-45">
                            <p></p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div id="dialogue-container">
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