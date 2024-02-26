console.log('loaded');
$(document).keypress(function(event) {
    //access the pressed key using event.key
    var pressedKey = event.key;
    console.log(pressedKey+" pressed");

    //get data-attr of every option on screen
    var availableElements = document.querySelectorAll('[data-key-param]');

    //iterate through the elements and find the matching key
    availableElements.forEach(function(element) {
        //parse the data-key-param attribute value as JSON
        var keyParam = JSON.parse(element.getAttribute('data-key-param'));

        //check if the pressed key matches the key in the attribute
        if (keyParam[pressedKey]) {
            //start transition
            console.log(keyParam[pressedKey]+" attached");
            //ajax request to retrieve new page and replace current
            $.ajax({
                url: '/ajax/' + keyParam[pressedKey],
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    //replace the body content with the new content
                    $('#game-container').fadeOut(2000, function() {
                        $('#game-container').html(response.elements).fadeIn();
                    });
                    bodyTransition(response.background);
                    if (response.autoTransitionDestination) {
                        setTimeout(() => {
                            $.ajax({
                                url: '/ajax/' + response.autoTransitionDestination,
                                method: 'GET',
                                success:function(response) {
                                    $('#game-container').fadeOut(2000, function() {
                                        $('#game-container').html(response.elements).fadeIn();
                                    });
                                    bodyTransition(response.background);
                                }
                            })
                        }, 4000);
                    }
                    if (response.redirectTo) {
                        setTimeout(() => {
                            console.log(response.redirectTo);
                            window.location=response.redirectTo;
                        }, 4000);
                    }
                },
                error: function(error) {
                    console.error('Error fetching content:', error);
                }
            });
        }
    });
});

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