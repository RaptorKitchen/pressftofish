$('body').css('overflow', 'hidden');
const lanes = {
    left: document.getElementById('speedLeftLane'),
    middle: document.getElementById('speedMiddleLane'),
    right: document.getElementById('speedRightLane')
};
const gameInput = document.getElementById('speedFishGameInput');
const scoreDisplay = document.getElementById('scoreDisplay');
let currentLane = 'middle';
let score = 0;

const laneFishPositions = {
    left: 400, // Set to 400 so the first fish can spawn immediately
    middle: 400,
    right: 400
};

function spawnFish() {
    const fishData = getRandomFishData();
    const laneKeys = Object.keys(lanes);
    const randomLaneKey = laneKeys[Math.floor(Math.random() * laneKeys.length)];

    // Check if the last fish has moved up enough to spawn a new one
    if (laneFishPositions[randomLaneKey] < 100) {
        return;
    }

    const fish = document.createElement('div');
    fish.classList.add('speed-fish');
    fish.textContent = fishData.title;
    fish.dataset.points = fishData.points;
    fish.style.bottom = '0';
    lanes[randomLaneKey].appendChild(fish);
    laneFishPositions[randomLaneKey] = 0; // Reset the position for the new fish

    let fishPosition = 0;
    const fishInterval = setInterval(() => {
        fishPosition += 8;
        fish.style.bottom = `${fishPosition}px`;
        laneFishPositions[randomLaneKey] = fishPosition; // Update the position of the last fish

        if (fishPosition >= 450) {
            clearInterval(fishInterval);
            fish.remove();
        }
    }, 100);

    setTimeout(() => { fish.style.borderColor = 'yellow'; }, 30000);
    setTimeout(() => { fish.style.borderColor = 'red'; }, 50000);
}

function getRandomFishData() {
    const options = [
        { title: 'salmon', points: 5 },
        { title: 'fishing rod', points: 10 },
        { title: 'boot', points: 0 },
        { title: 'tackle box', points: 15 },
        { title: 'lure', points: 10 },
        { title: 'trout', points: 5 },
        { title: 'bass', points: 5 },
        { title: 'reel', points: 10 },
        { title: 'line', points: 5 },
        { title: 'hook', points: 5 },
        { title: 'bait', points: 10 },
        { title: 'net', points: 10 },
        { title: 'waders', points: 15 },
        { title: 'cast', points: 5 },
        { title: 'catch and release', points: 20 },
        { title: 'fly fishing', points: 15 },
        { title: 'catfish', points: 5 },
        { title: 'carp', points: 5 },
        { title: 'spinnerbait', points: 10 },
        { title: 'jig', points: 10 },
        { title: 'pike', points: 5 },
        { title: 'walleye', points: 5 },
        { title: 'crappie', points: 5 },
        { title: 'trolling', points: 10 },
        { title: 'chumming', points: 15 },
        { title: 'swivel', points: 5 },
        { title: 'leader', points: 5 },
        { title: 'sinkers', points: 5 },
        { title: 'bobber', points: 5 },
        { title: 'plastic worms', points: 10 },
        { title: 'topwater lures', points: 10 },
        { title: 'fishing vest', points: 10 },
        { title: 'depth finder', points: 15 },
        { title: 'drift fishing', points: 10 },
        { title: 'spoons', points: 5 },
        { title: 'gaff', points: 10 },
        { title: 'live bait', points: 10 },
        { title: 'artificial bait', points: 10 },
        { title: 'barbless hook', points: 5 },
        { title: 'fish finder', points: 15 },
        { title: 'fishing license', points: 10 },
        { title: 'fishing knots', points: 10 },
        { title: 'ice fishing', points: 10 },
        { title: 'surf fishing', points: 10 },
        { title: 'trolling motor', points: 15 },
        { title: 'fishing charter', points: 15 },
        { title: 'fishing tournament', points: 20 },
        { title: 'catch limit', points: 10 },
        { title: 'filleting knife', points: 10 },
        { title: 'marlin', points: 5 },
        { title: 'tuna', points: 5 },
        { title: 'mackerel', points: 5 },
        { title: 'mahi mahi', points: 10 },
        { title: 'swordfish', points: 10 },
        { title: 'snapper', points: 5 },
        { title: 'grouper', points: 5 },
        { title: 'fishing diary', points: 15 },
        { title: 'tide chart', points: 10 },
        { title: 'fishing etiquette', points: 20 },
        { title: 'fish handling', points: 10 },
        { title: 'fishing technique', points: 15 }
    ];    

    return options[Math.floor(Math.random() * options.length)];
}

gameInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        const value = gameInput.value.toLowerCase();
        gameInput.value = '';

        if (value === 'left') {
            movePlayer('left');
        } else if (value === 'right') {
            movePlayer('right');
        } else {
            checkCatch(value);
        }
    }
});

function movePlayer(direction) {
    const laneOrder = ['left', 'middle', 'right'];
    const currentIndex = laneOrder.indexOf(currentLane);

    if (direction === 'left' && currentIndex > 0) {
        currentLane = laneOrder[currentIndex - 1];
    } else if (direction === 'right' && currentIndex < laneOrder.length - 1) {
        currentLane = laneOrder[currentIndex + 1];
    }

    updatePlayerPosition(currentLane);
    highlightActiveLane();
}

function updatePlayerPosition(currentLane) {
    console.log('#fisherman_'+currentLane);
    $('.fisherman').hide();
    $('#fisherman_'+currentLane).show();
}

function highlightActiveLane() {
    Object.keys(lanes).forEach(laneKey => {
        lanes[laneKey].classList.remove('active-lane');
    });
    lanes[currentLane].classList.add('active-lane');
}

function checkCatch(value) {
    const lane = lanes[currentLane];
    const fish = Array.from(lane.getElementsByClassName('speed-fish')).find(f => f.textContent.trim().toLowerCase() === value);

    if (fish) {
        score += parseInt(fish.dataset.points);
        scoreDisplay.textContent = `Score: ${score}`;
        if (score >= 100) {
            //win condition - show win modal
            showModal();
        }
        displayPoints(fish.dataset.points, fish.getBoundingClientRect());
        fish.remove();
    }
}

function displayPoints(points, fishRect) {
    const pointsDiv = document.createElement('div');
    pointsDiv.classList.add('points-display');
    pointsDiv.textContent = `+${points}`;
    pointsDiv.style.left = `${fishRect.left + fishRect.width / 2}px`;
    pointsDiv.style.top = `${fishRect.top - 20}px`;
    document.body.appendChild(pointsDiv);

    setTimeout(() => {
        pointsDiv.remove();
    }, 2000);
}

function showModal() {
    let modal = document.getElementById('fullPageModal');
    let resultText = document.getElementById('resultText');
    let html = '<div class="container text-center">';
        html += '<div class="row">';
            html += '<div class="col-12">';
                html += '<h1>Congratulations!</h1>';
                html += '<hr>';
            html += '</div>';
        html += '</div>';
        html += '<div class="row">';
            html += '<div class="col-12"><img class="" src="../images/snowy-sunset.jpg" width="100%"/></div>';
            html += '<div class="col-12">';
                html += '<p>Satisfied with your catch, you begin to make preparations to return to your boat. In the diminished light of the setting sun, you observe an unatural glow near the mountaintop.</p>';
                html += '<p>You are compelled to investigate it.</p>';
            html += '</div>';
        html += '<div class="row">';
            html += '<div class="col-12">';
                html += '<h1 class="floats">Press I to investigate the strange glow.</h1>';
            html += '</div>';
        html += '</div>';
    html += '</div>';
    
    resultText.innerHTML = html;
    

    modal.style.display = 'block';
                
    // Listen for 'i' keypress to close the modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'i' || event.key === 'I') {
            //TODO: trigger sound
            //TODO: timeout 2 seconds
            window.location = '/strange-glow';
        }
    });
}

setInterval(spawnFish, 5000);
$("#fisherman_left, #fisherman_right").hide();
highlightActiveLane();
