let line = document.getElementById('line');
let fishElements = document.getElementsByClassName('fish');
let rockElements = document.getElementsByClassName('rock');
let lure = document.getElementById('lure');
let score = 0;

let lineAngle = 0;
let lineDirection = 1; // 1 for down, -1 for up
let swingDirection = 1; // 1 for right, -1 for left
let lineLength = 25; // this val changes when cast
let initialLineLength = 25; //this is the default length
let lineMaxLength = 500;
let lineSpeed = 5;
let swingSpeed = 2;
let isLineMoving = false;
let isSwinging = true;
let caughtElement = null;
let retractSpeed = 5; // Default retract speed

function swingLine() {
    if (!isSwinging) return;

    lineAngle += swingDirection * swingSpeed;

    if (lineAngle > 85 || lineAngle < -85) {
        swingDirection *= -1; // Reverse the direction of the swing
    }

    line.style.transform = `translateX(-50%) rotate(${lineAngle}deg)`;

    // Update the position and rotation of the lure
    lure.style.transform = `translate(-50%, ${lineLength - 25}px) rotate(${lineAngle * 0.5}deg)`;
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
            retractLine();
        }
    } else {
        if (lineLength > initialLineLength) {
            lineLength -= retractSpeed;
        } else {
            lineDirection = 1;
            isLineMoving = false;
            isSwinging = true;
            if (caughtElement) {
                // Show modal for fish
                showModal();
                caughtElement.remove();
                caughtElement = null;
            }
        }
    }

    line.style.height = lineLength + 'px';
    line.style.transform = `translateX(-50%) rotate(${lineAngle}deg)`;
    checkCollision(); // Ensure collision check is performed during extension

    // Update the position and rotation of the lure to match the line
    let deltaX = lineLength * Math.sin(-lineAngle * Math.PI / 180); // Use the negative angle for correct horizontal direction
    let deltaY = lineLength * Math.cos(lineAngle * Math.PI / 180) - line.offsetWidth / 2; // Subtract half the line's width to align with the end
    lure.style.transform = `translate(${deltaX}px, ${deltaY}px) rotate(${lineAngle}deg)`;

    // Update the position of the caught element to follow the line only after it starts retracting
    if (caughtElement && lineDirection === -1) {
        caughtElement.style.transform = `translate(${deltaX}px, ${deltaY}px) rotate(${lineAngle}deg)`;
    }
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
function showModal() {
    let modal = document.getElementById('fullPageModal');
    let resultText = document.getElementById('resultText');

    // Add AJAX response text here
    let html = '<div class="container text-center">';
        html += '<div class="row">';
            html += '<div class="col-12">';
                html += '<h1>Fish Caught!</h1>';
            html += '</div>';
        html += '</div>';
        html += '<div class="row">';
            html += '<div class="col-6">[FISH IMAGE]</div>';
            html += '<div class="col-6">';
                html += '<div class="row">';
                    html += '<div class="col-12">';
                        html += '<h2>Fish Name</h2>';
                        html += '<h4 class="font-italic">Latin Name</h4>';
                        html += '<hr />';
                    html += '</div>';
                html += '</div>';
                html += '<div class="row">';
                    html += '<div class="col-4"><span>[Fish Age]</span></div>';
                    html += '<div class="col-4"><span>[Fish Weight]</span></div>';
                    html += '<div class="col-4"><span>[Fish Length]</span></div>';
                html += '</div>';
                html += '<div class="row">';
                    html += '<div class="col-12">';
                        html += '<p>Fish Description</p>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
        html += '<div class="row">';
            html += '<div class="col-12">';
                html += '<h1>Press C to Continue</h1>';
            html += '</div>';
        html += '</div>';
    html += '</div>';
    
    resultText.innerHTML = html;
    

    modal.style.display = 'block';

    // Listen for 'c' keypress to close the modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'c' || event.key === 'C') {
            modal.style.display = 'none';
        }
    });
}
 