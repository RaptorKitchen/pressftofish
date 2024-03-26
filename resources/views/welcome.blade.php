@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="background-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 89vh;">
            <div class="text-center">
                <div class="row">
                    <div class="col-12">
                        <img src="./images/pftf-logo.png" class="text-center img-responsive" width="350" style="margin-top: -35%; margin-bottom: 150px" id="animatedLogoPrimary" class="floats"/>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="input-container">
                            <form id="startSession" action="{{ route('start') }}" method="POST">
                                @csrf
                                <input type="text" id="game-input" placeholder="Type start to begin..." autocomplete="off">
                                <span class="enter-icon">&#8629;</span>
                            </form>
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
@endsection

@section('scripts')
<script src="{{ asset('js/game.js') }}"></script>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
