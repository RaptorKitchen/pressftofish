let line = document.getElementById('line');
let fishElements = document.getElementsByClassName('fish');
let rockElements = document.getElementsByClassName('rock');
let lure = document.getElementById('lure');
let score = 0;

let lineAngle = 0;
let lineDirection = 1; // 1 for down, -1 for up
let swingDirection = 1; // 1 for right, -1 for left
let lineLength = 50; // this val changes when cast
let initialLineLength = 50; //this is the default length
let lineMaxLength = 650;
let lineSpeed = 5;
let swingSpeed = 2;
let isLineMoving = false;
let isSwinging = true;
let caughtElement = null;
let retractSpeed = 5; // Default retract speed
let fishAvailable = fishElements.length;

$('body').css('overflow','hidden');

function swingLine() {
    if (!isSwinging) return;

    lineAngle += swingDirection * swingSpeed;

    if (lineAngle > 85 || lineAngle < -85) {
        swingDirection *= -1; // Reverse the direction of the swing
    }

    line.style.transform = `translateX(-50%) rotate(${lineAngle}deg)`;
    /* make hooks sway (commented out because they sway too much)
    document.getElementById('hook1').style.transform = `translateX(-25%) rotate(${lineAngle}deg)`; // Rotate hook1
    document.getElementById('hook2').style.transform = `translateX(-25%) rotate(${lineAngle}deg)`; // Rotate hook2
    */
}

function retractLine() {
    isLineMoving = true;
    lineDirection = -1;
}

function checkCollision() {
    let lineRect = line.getBoundingClientRect();
    if (lineDirection === 1) { // Check collision only when line is moving down
        for (let fish of fishElements) {
            let fishRect = fish.getBoundingClientRect();
            if (lineRect.right > fishRect.left && lineRect.left < fishRect.right && lineRect.bottom > fishRect.top && lineRect.top < fishRect.bottom) {
                caughtElement = fish;
                retractSpeed = 2; // Middle speed for fish
                lineDirection = -1; // Start retracting
                break;
            }
        }

        for (let rock of rockElements) {
            let rockRect = rock.getBoundingClientRect();
            if (lineRect.right > rockRect.left && lineRect.left < rockRect.right && lineRect.bottom > rockRect.top && lineRect.top < rockRect.bottom) {
                caughtElement = rock;
                retractSpeed = 1; // Slowest speed for rocks
                lineDirection = -1; // Start retracting
                break;
            }
        }
    }

    // Reset retractSpeed to fastest if nothing was caught
    if (caughtElement === null) {
        retractSpeed = 5;
    }
}

function castLine() {
    if (!isLineMoving) return;

    if (lineDirection === 1) {
        if (lineLength < lineMaxLength) {
            lineLength += lineSpeed;
        } else {
            retractLine(-5);
        }
    } else {
        if (lineLength > initialLineLength) {
            lineLength -= lineSpeed;
            if (caughtElement) {
                // Calculate the position based on the line's angle and length
                let deltaX = lineLength * Math.sin(lineAngle * Math.PI / 180);
                let deltaY = lineLength * Math.cos(lineAngle * Math.PI / 180);
                caughtElement.style.left = (line.offsetLeft - deltaX) + 'px';
                caughtElement.style.top = (line.offsetTop + deltaY) + 'px';
            }
        } else {
            if (caughtElement) {
                if (caughtElement.classList.contains('fish')) {
                    fishAvailable--;
                    showModal('fish');
                } else if (caughtElement.classList.contains('rock')) {
                    showModal('rock');
                }
                // Clear the caught element
                caughtElement.remove();
                caughtElement = null;
            }
            lineDirection = 1;
            isLineMoving = false;
            isSwinging = true;
        }
    }

    line.style.height = lineLength + 'px';
    line.style.transform = `translateX(-50%) rotate(${lineAngle}deg)`;
    checkCollision(); // Ensure collision check is performed during extension
}

function startLineMovement() {
    if (!isLineMoving) {
        isLineMoving = true;
        isSwinging = false;
        lineDirection = 1;
        caughtElement = null; // Reset caughtElement when starting a new cast
    }
}

document.addEventListener('keydown', function(event) {
    if (event.key === ' ' && !isLineMoving) {
        startLineMovement();
    }
});

setInterval(swingLine, 50);
setInterval(castLine, 20);

//modal code
function showModal(fishOrRock) {
    switch(fishOrRock) {
        case 'fish':
            console.log('fish caught');
            $.ajax({
                url: '/get-random-fish',
                method: 'GET',
                success: function(response) {
                    console.log('Random fish:', response.name);
                    let modal = document.getElementById('fullPageModal');
                    let resultText = document.getElementById('resultText');
                
                    // Add AJAX response text here
                    let html = '<div class="container text-center">';
                        html += '<div class="row">';
                            html += '<div class="col-12">';
                            if (fishAvailable === 0) {
                                html += '<h1>Last Fish Caught!</h1>';
                            } else {
                                html += '<h1>Fish Caught!</h1>';
                            }
                            html += '</div>';
                        html += '</div>';
                        html += '<div class="row">';
                            html += '<div class="col-6"><img class="fish-image" src="../images/fish/'+response.image_url+'" width="100%"/></div>';
                            html += '<div class="col-6">';
                                html += '<div class="row">';
                                    html += '<div class="col-12">';
                                        html += '<h2>'+response.name+'</h2>';
                                        html += '<h4 class="font-italic">'+response.latin_name+'</h4>';
                                        html += '<hr />';
                                    html += '</div>';
                                html += '</div>';
                                html += '<div class="row">';
                                    html += '<div class="col-12">';
                                        html += '<p class="mt-4">'+response.description+'</p>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                        html += '<div class="row">';
                            html += '<div class="col-12">';
                                html += '<hr />';
                                html += '<p>Further Reading: <a href="'+response.further_reading+'" target="_blank">'+response.further_reading+'</a>';
                            html += '</div>';
                        html += '</div>';
                        html += '<div class="row">';
                            html += '<div class="col-12">';
                                if (fishAvailable === 0) {
                                    html += "<p>You've caught every fish in the lake. You suspect there are more fish in the mountain streams.</h1>";
                                    html += '<h1 class="floats">Press C to Climb the mountain.</h1>';
                                } else {
                                    html += '<h1 class="floats">Press C to Continue</h1>';
                                }
                            html += '</div>';
                        html += '</div>';
                    html += '</div>';
                    
                    resultText.innerHTML = html;
                    
                
                    modal.style.display = 'block';
                
                    // Listen for 'c' keypress to close the modal
                    document.addEventListener('keydown', function(event) {
                        if (event.key === 'c' || event.key === 'C') {
                            if (fishAvailable === 0) {
                            // are there any other fish left? if not, continue to mountain
                            //TODO: trigger sound
                            //TODO: timeout 2 seconds
                            window.location = '/speed-fishing';
                            console.log('no more fish');
                            } else {
                                modal.style.display = 'none';
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching random fish:', error);
                }
            });
            break;
        case 'rock' :
            console.log('rock caught');
            break;
    }
}

 