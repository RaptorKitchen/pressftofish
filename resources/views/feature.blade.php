@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="survey-container">
        <div class="container align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="amarante-regular">Name these locations</h1>
                </div>
            </div>
            <form action="{{ route('feature.store') }}" method="POST" class="text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <label for="feature_mountain" class="amarante-regular">The Mountain:</label>
                <input type="text" id="feature_mountain" name="feature[mountain]" value="{{ $features['mountain'] ?? '' }}" autocomplete="off" required>
                
                <label for="feature_lake" class="amarante-regular">The Lake:</label>
                <input type="text" id="feature_lake" name="feature[lake]" value="{{ $features['lake'] ?? '' }}" autocomplete="off" required>
                
                <label for="feature_cave" class="amarante-regular">The Cave:</label>
                <input type="text" id="feature_cave" name="feature[cave]" value="{{ $features['cave'] ?? '' }}" autocomplete="off" required>
    
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
