let line = document.getElementById('line');
let fishElements = document.getElementsByClassName('fish');
let rockElements = document.getElementsByClassName('rock');
let score = 0;

let lineAngle = 0;
let lineDirection = 1; // 1 for down, -1 for up
let swingDirection = 1; // 1 for right, -1 for left
let lineLength = 5;
let lineMaxLength = 500;
let lineSpeed = 2;
let swingSpeed = 2;
let isLineMoving = false;
let isSwinging = true;
let caughtElement = null;

function swingLine() {
    if (!isSwinging) return;

    lineAngle += swingDirection * swingSpeed;

    if (lineAngle > 85 || lineAngle < -85) {
        swingDirection *= -1; // Reverse the direction of the swing
    }

    line.style.transform = `translateX(-50%) rotate(${lineAngle}deg)`;

    // Update the position and rotation of the lure
    let lure = document.getElementById('lure');
    lure.style.transform = `translate(-50%, ${lineLength - 25}px) rotate(${lineAngle * 0.5}deg)`;
}

function castLine() {
    if (!isLineMoving) return;

    if (lineDirection === 1) {
        if (lineLength < lineMaxLength) {
            lineLength += lineSpeed;
        } else {
            lineDirection = -1;
        }
    } else {
        if (lineLength > 50) {
            lineLength -= lineSpeed;
        } else {
            lineDirection = 1;
            isLineMoving = false;
            isSwinging = true;
            if (caughtElement && caughtElement.classList.contains('fish')) {
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

    // Update the position of the lure
    let lure = document.getElementById('lure');
    lure.style.transform = `translate(-50%, ${lineLength - 25}px) rotate(${lineAngle * 0.5}deg)`;
}

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
                // TODO: AJAX request to retrieve random fish in allowed time and season
                // TODO: compare energy of fisherman with weight of fish attempted, run dice roll to determine success
                caughtElement = fish;
                lineDirection = -1; // Stop extending and start retracting
                break;
            }
        }

        for (let rock of rockElements) {
            let rockRect = rock.getBoundingClientRect();
            if (lineRect.right > rockRect.left && lineRect.left < rockRect.right && lineRect.bottom > rockRect.top && lineRect.top < rockRect.bottom) {
                caughtElement = rock;
                lineDirection = -1; // Stop extending and start retracting
                break;
            }
        }
    }
}

function startLineMovement() {
    if (!isLineMoving) {
        isLineMoving = true;
        isSwinging = false;
        lineDirection = 1;
    }
}

document.addEventListener('keydown', function(event) {
    if (event.key === ' ' && !isLineMoving) {
        startLineMovement();
    }
});

// TODO: increase swing when intoxicated
setInterval(swingLine, 50);
setInterval(castLine, 20);
 