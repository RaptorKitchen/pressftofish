@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="survey-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center">
                <div id="game-container">
                    <h1 class="animate-text amarante-regular remove-on-press">Type any object or feature you see</h1>
                </div>
            </div>
        </div>
        <form action="{{ route('feature.store') }}" method="POST" class="text-center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <label for="feature_mountain">The Mountain:</label>
            <input type="text" id="feature_mountain" name="feature[mountain]" value="{{ $features['mountain'] ?? '' }}">
            
            <label for="feature_lake">The Lake:</label>
            <input type="text" id="feature_lake" name="feature[lake]" value="{{ $features['lake'] ?? '' }}">
            
            <label for="feature_cave">The Cave:</label>
            <input type="text" id="feature_mountain" name="feature[mountain]" value="{{ $features['cave'] ?? '' }}">

            <button type="submit">Submit</button>
        </form>

    </div>
