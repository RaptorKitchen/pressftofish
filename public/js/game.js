var inputField = document.getElementById('game-input');

$(document).ready(function() {
    console.log('dom ready, listening for keypresses');
    $(inputField).focus();
    $(inputField).on('keydown', function(event) {
        if (event.key === 'Enter') {
            var inputValue = $(this).val().toLowerCase();
            console.log(inputValue + ' submitted');
            $(this).val(''); // Clear the input field
            // Handle the input value (e.g., check for commands or dialogue options)
            handleInput(inputValue);
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
  
function handleInput(inputValue) {
    // Array of available routes
    const availableRoutes = ['start', 'mirror', 'survey', 'fish', 'mountain', 'shop', 'cave', 'journal'];
    
    if (availableRoutes.includes(inputValue)) {
        console.log(inputValue+' is a valid route');
        ajaxRefreshPageContent(inputValue);
    } else {
        console.log(inputValue+' is an invalid route');
        // Invalid command
        shakeInput();
    }
}

function ajaxRefreshPageContent(inputValue) {
    console.log('page refresh attempt');
    $.ajax({
        url: '/ajax/' + inputValue,
        method: 'GET',
        success: function(response) {
            console.log('page refresh successful');
            //before anything else happens, make sure user has cleared mirror before continuing to other routes
            var keywords = {
                'shard-left': response.isLeftShard,
                'shard-center': response.isCenterShard,
                'shard-right': response.isRightShard
            };

            Object.keys(keywords).forEach(function(key) {
                var shard = document.querySelector('.' + key);
                if (keywords[key]) {
                    shard.classList.add('visible');
                } else {
                    shard.classList.remove('visible');
                }
            });

            //replace the body content with the new content
            $('#game-container').fadeOut(2000, function() {
                console.log('body content refresh attempt');
                $('#game-container').html(response.elements).fadeIn();
                // render dialogue when present
                renderResponseDialogue(response);
            });

            bodyTransition(response.background);
            if (response.autoTransitionDestination) {
                console.log('attempting auto-transition');
                setTimeout(() => {
                    $.ajax({
                        url: '/ajax/' + response.autoTransitionDestination,
                        method: 'GET',
                        success:function(response) {
                            console.log('auto-transition succeeded');
                            $('#game-container').fadeOut(2000, function() {
                                console.log('auto-transition content refresh');
                                $('#game-container').html(response.elements).fadeIn();
                                // render dialogue when present
                                renderResponseDialogue(response);
                            });
                            bodyTransition(response.background);
                        }
                    })
                }, 4000);
            }
        },
        error: function(error) {
            console.error('Error fetching content:', error);
        }
    });
}

//get all elements with class "animate-text"
var animateElements = document.querySelectorAll('.animate-text');

//apply different animation delays to each element
animateElements.forEach(function(element, index) {
    element.style.animationDelay = index * 0.1 + 's';
});

function bodyTransition(background) {
    $('#background-container').fadeOut(2000, function() {
        $('#background-container').css("background-image", "url("+background+")").fadeIn("slow").fadeIn(2000);
    });
}

function renderResponseDialogue(response) {
    console.log('response dialogue attempt');
    if (response.dialogue) {
        console.log('response dialogue found');
        console.log(response.dialogue);
        var dialogueHtml = '<x-dialogue :text="' + response.dialogue.text + '" :options="' + JSON.stringify(response.dialogue.options) + '"></x-dialogue>';
        $('#game-container').append(dialogueHtml);
    }
}

function shakeInput() {
    $(inputField).parent().addClass('shake');
    setTimeout(() => {
        $(inputField).parent().removeClass('shake');
    }, 1000);
}
