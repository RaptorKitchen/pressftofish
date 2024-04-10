var inputField = document.getElementById('game-input');
var caveInputField = document.getElementById('cave-input');

$(document).ready(function() {
    console.log('dom ready, listening for keypresses');
    $(inputField).focus();
    $(caveInputField).focus();
    $(inputField).on('keydown', function(event) {
        if (event.key === 'Enter') {
            var inputValue = $(this).val().toLowerCase();
            console.log(inputValue + ' submitted');
            $(this).val('');
            handleInput(inputValue);
        }
    });
    $(caveInputField).on('keydown', function(event) {
        var round = $('#round').val();
        if (event.key === 'Enter') {
            var inputValue = $(this).val().toLowerCase();
            console.log(inputValue + ' submitted');
            $(this).val('');
            handleCaveInput(inputValue, round);
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

function handleCaveInput(inputValue, round) {
    // Object of available responses for each round
    const availableResponses = {
        '1': [
            '3', 'three', 'release', 'kill', 'inspect', 'tasty', 'apologize', 'question', 'leave', 'run', 'flee', 'help', 'fight', 'attack'
        ],
        '2': [
            'who', 'why', 'what'
        ],
        '3': [],
        '4': [],
        '5': []
    };

    // validate responses
    if (availableResponses[round] && availableResponses[round].includes(inputValue)) {
        console.log(inputValue + ' is a valid route');
        if (round == 1) {
            switch(inputValue) {
                case ('3' || 'three'):
                    updateCaveChoices("The creature seems pleased with your answer. It smears a new message onto the cave walls:",'✡︎','✞','☪',2);
                    break;
                case 'release':
                    updateCaveChoices("The creature before you makes a series of squeals and clicking noises that reverberate throughout the walls of the cave. You suspect the creature is trying to communicate. It smears bioluminscent ink along the walls:","🐟 + 🐟","+ 🐟 = ", "?", 1);
                    break;
                case 'kill':
                    updateCaveChoices("The creature before you unleashes an ear-splitting scream. You feel a force slithering into your mind. For a moment you think you can focus your thoughts and fight it, but you also feel a growing desire to relax your mind and let go.","<em>Focus</em> your mind to fight the invading presence","<em>Let go</em>, and accept the invading prescence","<em>Flee</em>",2);
                    break;
                case 'inspect':
                    updateCaveChoices("The strange fish stops thrashing, turning one of it's glowing eyes upon you. The assault of the clicks lessen to a comfortable volume. The cacophony of sounds become organized. \"Fish-\"... \"Fisherman...\" You can now make sense of the clicks, hear the elegance in the rhythms.  The creature is asking a question.<br />\"Why, fisherman. Why did you take my fish?\"","To <em>study</em> it.","To <em>sell</em> it.","To <em>eat</em> it",2);
                    break;
                case 'tasty':
                    updateCaveChoices("The creature makes a sound that could be considering crying or laughter. You're not sure which. Maybe it's both.","<em>Laugh</em> with the creature.","<em>Cry</em> with the creature.","Stay <em>silent</em>",2);
                    break;
                case 'apologize':
                    updateCaveChoices("The creature seems intrigued. This time it brings forward three images: the first; a galaxy, the second; a tornado, the last; a hurricane.","Say you see <em>chaos</em>","Say you see <em>order</em>.","Say you see <em>spirals</em>",2);
                    break;
                case 'question':
                    updateCaveChoices("The creature becomes silent.","<em>Who</em> are you?","","<em>What</em> do you want?",2);
                    break;
                case 'leave' || 'run' || 'flee':
                    //can't leave
                    updateAdditionalText("You turn to make a run for the mouth of the cave. Within two strides your vision goes dark and your legs go limp. You find yourself facing the creature again. It won't let you flee.");
                    break;
                case 'fight' || 'attack':
                    updateAdditionalText("You tense your muscles up in preparation for a wild swing on the creature before you. The creature sounds an incapacitating shrill. ");
                case 'help':
                    updateAdditionalText("Considering what the creature did to your ship, you think it could make quick work of you. Best to play along and figure out what it wants.");
                    break;
            }
        }
        if (round == 2) {
            switch(inputValue) {
                case "focus":
                    // darken page
                    // pulse animation
                    initializeGrid('focus');
                    break;
                case "fight":
                    // darken
                    // show health
                    // dice roll for attack, unwinnable
                    break;
                case "flee":
                    // darken page
                    // pulse animation
                    initializeGrid('flee');
                    break;
                case "religion" || "religious symbols" || "religions" || "religious":
                    //updateCaveChoices("The creature seems pleased that you've have some understanding of religion.","","","",3);
                    break;
                case "study":
                    // imprison, make screensaver
                    break;
                case "sell":
                    // prepare for sell
                    break;
                case "eat":
                    // prepare for meal
                    break;
                case "laugh":
                    // jokes? release
                    break;
                case "cry":
                    // comfort, release
                    break;
                case "silent":
                    //  comfort, release
                    break;
                case "chaos":
                    // universe ending
                    break;
                case "order":
                    // universe ending
                    break;
                case "spirals":
                    // madness ending
                    break;
            }
        }
        /* future rounds
        if (round == 3) {
            switch(inputValue) {
            }
        }
        if (round == 4) {
            switch(inputValue) {
            }
        }
        if (round == 5) {
            switch(inputValue) {
            }
        }
        */
    } else {
        console.log(inputValue + ' is an invalid route');
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
    $(caveInputField).addClass('shake');
    setTimeout(() => {
        $(caveInputField).removeClass('shake');
    }, 1000);
}

function startCaveSection(status) {
    $('.choice-label').hide();
    console.log('cave status: ', status);
    setTimeout(() => {
        shakeBodyAndFadeInElderFish();
        $("#caveDialogueContainer").fadeIn();
        if (status == 'left') {
            $("#elderFishDialogue").text("The creature before you makes a series of squeals and clicking noises that reverberate throughout the walls of the cave. You suspect the creature is trying to communicate. It smears bioluminscent ink along the walls:");
            updateCaveChoices(null,"🐟 + 🐟","+ 🐟 = ", "?", 1);
        } else if (status == 'taken') {
            $("#elderFishDialogue").text("The strange fish you are carrying has become uneasy. You cannot tell if the strange fish is afraid or excited.");
            updateCaveChoices(null,'<em>release</em> to release the Strange Fish.', '<em>kill</em> to stop the Strange Fish from struggling.', '<em>inspect</em> to check on the Strange Fish.', 1);
        } else if (status == 'fed') {
            $("#elderFishDialogue").html("The creature before you makes a series of squeals and piercing clicks that reverberate throughout the walls of the cave. You feel the clicks pass through you, rattling your bones, making it difficult to think, to speak, even to see. Any semblance of light in the cave is gone and with every click, thousands of images shine brightly in your mind's eye. <br />An image of a freshly cooked seafood seafood dinner comes to you. The clicks stop and you feel the Creature's gaze upon you, seemingly awaiting an answer.");
            updateCaveChoices(null,'Tell the creature the dish looks "<em>tasty</em>".','"<em>Apologize</em>".','Ask the Creature a "<em>question</em>".', 1);
        }
        $("#elderFishDialogueContainer").fadeIn();
    }, 2000);
}

function updateCaveChoices(dialogue,left,center,right,round) {
    $("#round").val(round);
    if (dialogue) {
        $("#elderFishDialogue").html(dialogue);
    }
    if (left) {
        $('#leftChoiceLabel').html(left);
    }
    if (center) {
        $('#centerChoiceLabel').html(center);
    }
    if (right) {
        $('#rightChoiceLabel').html(right);
    }
}

function updateAdditionalText(text) {
    $("#additionalText").html(text);
    $("#additionalText").fadeIn();
    setTimeout(function() {
        $("#additionalText").fadeOut();
    }, 5000);
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