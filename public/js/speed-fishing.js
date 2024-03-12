const lanes = {
    left: document.getElementById('speedLeftLane'),
    middle: document.getElementById('speedMiddleLane'),
    right: document.getElementById('speedRightLane')
};
const player = document.getElementById('player');
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
    if (laneFishPositions[randomLaneKey] < 300) { // Adjusted to 300
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

        if (fishPosition >= 550) {
            clearInterval(fishInterval);
            fish.remove();
        }
    }, 1000);

    setTimeout(() => { fish.style.borderColor = 'yellow'; }, 30000);
    setTimeout(() => { fish.style.borderColor = 'red'; }, 50000);
}

function getRandomFishData() {
    const options = [
        { title: '<div>', points: 5 },
        { title: 'color:blue;', points: 5 },
        { title: 'addEventListener', points: 15 },
        { title: 'document.querySelector', points: 20 },
        { title: 'background-color:red;', points: 10 },
        { title: '<h1>', points: 5 },
        { title: 'margin:0;', points: 5 },
        { title: 'function()', points: 10 },
        { title: 'console.log', points: 15 },
        { title: 'border-radius:50%;', points: 10 },
        { title: '<img src="" alt="">', points: 15 },
        { title: 'flex-direction:row;', points: 10 },
        { title: 'Array.forEach()', points: 20 },
        { title: '<a href="#target">Link</a>', points: 10 },
        { title: 'padding:10px;', points: 5 }
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
    console.log(currentLane);
    $('.fisherman').hide();
    $('.fisherman .'+currentLane).show();
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

setInterval(spawnFish, 5000);
updatePlayerPosition();
highlightActiveLane();
