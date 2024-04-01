@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="survey-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="text-center">                
                <h1 class="animate-text amarante-regular remove-on-press"></h1>
            </div>
            <div class="row">
                <div id="survey" class="text-center">
                    <div class="row">
                        <div id="splashMessageContainer" class="mb-5 floats">
                            <div id="splashMessage">
                                <h3>Note: This website is designed for desktop only.</h3>
                                <h3>Type "ok" to proceed, then press Enter:</h3>
                            </div>
                            <div id='fishCatchaContainer'>
                                <div class='container'>
                                    <div class='row'>
                                        <div class='col-10 mt-4'>
                                            <h3 class="text-left">Click to confirm you are not a fish</h3>
                                            <div class="fishCatchaContainer d-flex align-items-center">
                                                <input id="fishCatchaCheckbox" type="checkbox" name="fishCatcha" class="fs-3" />
                                                <label for="fishCatcha" id="fishCatchaLabel" class="fs-3">I am not a fish</label>
                                            </div>
                                        </div>
                                        <div class='col-2 text-center'>
                                            <img src='./images/fishcatcha-logo.png' class='w-100' />
                                            <p>fishCATCHA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="splash-input">
                                <input type="text" class="w-100 pl-2" id="inputField" placeholder="Press Enter to submit your answers" autocomplete="off" data-splash="ok" autofocus>
                                <span class="enter-icon" id="splashEnterIcon">&#8629;</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!--<script src="{{ asset('js/survey.js') }}"></script>-->
<script>
var inputField = document.getElementById('inputField');

$(document).ready(function() {
    console.log('dom ready, listening for keypresses');
    $(inputField).focus();
    $(inputField).on('keydown', function(event) {
        if (event.key === 'Enter') {
            var inputValue = $(this).val().toLowerCase();
            console.log(inputValue + ' submitted');
            $(this).val('');
            handleSplashInput(inputValue);
        }
    });
});

function handleSplashInput(inputValue) {
    if (!getNextResponse(inputValue)) {
        shakeInput();
    } else {
        console.log(inputValue + ' is a valid response');
    }
}

function shakeInput() {
    $(inputField).parent().addClass('shake');
    setTimeout(() => {
        $(inputField).parent().removeClass('shake');
    }, 1000);
}

function getNextResponse(currentResponse) {
    var responseOrder = ['ok', 'no', 'yes'];
    var currentIndex = responseOrder.indexOf(currentResponse);
    var expectedResponse = $(inputField).data('splash');

    if (currentResponse !== expectedResponse) {
        // invalid response
        return false;
    }

    // update splash message
    function updateSplashMessage(message) {
        $("#splashMessage").html(message).fadeIn();
    }

    if (currentIndex === 0) {
        // Are you a fish?
        $("#splashMessage").fadeOut(function() {
            updateSplashMessage("<h3>This website is intended for human use only. It is not intended to be used by fish.</h3><h3>Are you a fish?</h3>");
        });
    } else if (currentIndex === 1) {
        // Are you sure?
        $("#splashMessage").fadeOut(function() {
            updateSplashMessage("<h3>Are you sure?</h3>");
        });
    } else if (currentIndex === 2) {
        $("#splashMessage").fadeOut(function() {
            $("#splashMessage").empty();
            $("#inputField").parent().parent().parent().fadeOut();
            $("#fishCatchaContainer").fadeIn();
        });
    }

    // Update the expected response for the next input
    var nextIndex = (currentIndex + 1) % responseOrder.length;
    $(inputField).data('splash', responseOrder[nextIndex]);

    // valid response
    return true;
}

function emptySplash() {
    $("#splashMessage").fadeOut();
    $("#splashMessage").empty();
}

$(document).ready(function() {
    $('#fishCatchaCheckbox').change(function() {
        if (this.checked) {
            $('#fishCatchaContainer').fadeOut(1000, function() {
                $(this).html('<h3>Thank you for confirming your humanity. You may fish now.</h3>');
                $(this).fadeIn(1000);
            });
            $('body').fadeOut(4000, function() {
                window.location = '/start';
            });
        }
    });
});

</script>
@endsection