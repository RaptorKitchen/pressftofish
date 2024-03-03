@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
<div class="mirror-background">
    <div class="content-container">
        <div class="video-container">
            <video id="inputVideo" autoplay muted height="100%"></video>
            <canvas id="overlay" height="100%"></canvas>
            <canvas id="webgl" height="100%"></canvas>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="animate-text amarante-regular">Press A to Admire Your Reflection</h1>
                    <h1 class="animate-text amarante-regular">Press C to Capture The Moment</h1>
                    <div id="controls" class="d-none">
                        <select name="deformation" id="deform">
                            <option value="unwell">Unwell</option>
                            <option value="inca">Inca</option>
                            <option value="cheery">Cheery</option>
                            <option value="dopey">Dopey</option>
                            <option value="longface">Longface</option>
                            <option value="lucky">Lucky</option>
                            <option value="overcute">Overcute</option>
                            <option value="aloof">Aloof</option>
                            <option value="evil">Evil</option>
                            <option value="artificial">Artificial</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/mirror/clmtrackr.js') }}"></script>
    <script src="{{ asset('js/mirror/dat.gui.min.js') }}"></script>
	<script src="{{ asset('js/mirror/utils.js') }}"></script>
	<script src="{{ asset('js/mirror/webgl-utils.js') }}"></script>
	<script src="{{ asset('js/mirror/model_pca_20_svm.js') }}"></script>
	<script src="{{ asset('js/mirror/Stats.js') }}"></script>
	<script src="{{ asset('js/mirror/face_deformer.js') }}"></script>
	<script src="{{ asset('js/mirror/poisson_new.js') }}"></script>
    <script src="{{ asset('js/mirror.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script>
        function captureAndSave() {
            html2canvas(document.querySelector("#captureRegion")).then(canvas => {
                // Convert the canvas to a data URL
                var imageData = canvas.toDataURL("image/jpeg");

                // Send the image data to the server via AJAX
                $.ajax({
                    url: "{{ route('saveProfileImage') }}",
                    type: "POST",
                    data: {
                        image: imageData,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            alert("Image saved successfully!");
                            // Update the user's profile image on the page if needed
                        } else {
                            alert("Error saving image.");
                        }
                    }
                });
            });
        }
    </script>
@endsection
