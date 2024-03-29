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
    const availableRoutes = ['start', 'mirror', 'attempt-fish', 'cabin', 'survey', 'fish', 'mountain', 'shop', 'cave', 'journal', 'leave', 'take', 'feed'];

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
            const newUrl = '/' + inputValue;
            history.pushState(null, '', newUrl);
            var keywords = {
                'shard-left': response.isLeftShard,
                'shard-center': response.isCenterShard,
                'shard-right': response.isRightShard
            };

            if (response.autoTransitionDestination) {
                bodyTransition(response);
            }

            Object.keys(keywords).forEach(function(key) {
                var shard = document.querySelector('.' + key);
                if (shard) {
                    if (keywords[key]) {
                        shard.classList.add('visible');
                    } else {
                        shard.classList.remove('visible');
                    }
                }
            });

            // replace the body content with the new content
            $('#game-container').fadeOut(2000, function() {
                console.log('body content refresh attempt');
                $('#game-container').html(response.elements).fadeIn();
                // render dialogue when present
                renderResponseDialogue(response);
                // remove strange glow container class
                $('.strange-glow-container').removeClass('strange-glow-container');
            });

            if (response.background) {
                bodyTransition(response);
            }

            if (response.autoTransitionDestination) {
                let caveStatus = (response.caveStatus) ? '/' + response.caveStatus : '';
                console.log('attempting auto-transition');
                const newUrl = '/' + response.autoTransitionDestination;
                history.pushState(null, '', newUrl);
                setTimeout(() => {
                    $.ajax({
                        url: '/ajax/' + response.autoTransitionDestination + caveStatus,
                        method: 'GET',
                        success:function(response) {
                            console.log('auto-transition succeeded');
                            $('#game-container').fadeOut(2000, function() {
                                if (response.isCave) {
                                    // remove off to fish background, remove regal gradient
                                    $('#game-container').css( "background-image", response.background );
                                    $('.gradient-background').css('background','linear-gradient(to bottom, #182644 0%, #514960 50%, #0c011b 80%)');
                                    $('.gradient-background').css('background-color','#0c011b');
                                    $('.gradient-background').css('background-repeat', 'no-repeat');
                                    startCaveSection(response.caveStatus);
                                }
                                console.log('auto-transition content refresh');
                                $('#game-container').html(response.elements).fadeIn();
                                // render dialogue when present
                                renderResponseDialogue(response);
                                // check for data-key-param elements in case this is a page that uses them
                                var element = document.querySelector('[data-key-param]');
    
                                if (element) {
                                    var keyParam = JSON.parse(element.getAttribute('data-key-param'));
                                
                                    document.addEventListener('keypress', function(event) {
                                        var pressedKey = event.key.toLowerCase();
                                
                                        if (keyParam.hasOwnProperty(pressedKey)) {
                                            handleInput(keyParam[pressedKey]);
                                        }
                                    });
                                }
                            });
                            bodyTransition(response);
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

function bodyTransition(response) {
    $('#game-container').fadeOut(2000, function() {
        $('#game-container').css("background-image", "url("+response.background+")").fadeIn("slow").fadeIn(2000);
        if (response.bodyBackground) {
            $('body').css("background-image", response.bodyBackground).fadeIn("slow").fadeIn(2000);
            $('body').css("background-repeat", response.bodyBackgroundRepeat).fadeIn("slow").fadeIn(2000);
        }
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

function startCaveSection(status) {
    console.log('cave status: ', status);
    setTimeout(() => {
        shakeBodyAndFadeInElderFish();
        // TODO: start elder fish dialogue featuring status
            // left strange fish
                // questionaire?
            // took strange fish
                // simple rpg battle using static set of fish for now
            // fed strange fish
                // trivia?
        // TODO: last game depends on status
    }, 2000);
}

function shakeBodyAndFadeInElderFish() {
    $('body').addClass('shake');
    $('body').css('overflow','hidden');
    setTimeout(function() {
        $('body').removeClass('shake');
        $('body').css('overflow','inherit');
        $('#elderFish').fadeIn('slow');
    }, 4000);
}

$('#startForm').submit(function(event) {
    event.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            console.log('Session started and user created');
            ajaxRefreshPageContent('cabin');
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error starting session:', error);
        }
    });
});