$('body').css('overflow', 'hidden');
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
        { title: 'Salmon', points: 5 },
        { title: 'Fishing Rod', points: 10 },
        { title: 'Tackle Box', points: 15 },
        { title: 'Lure', points: 10 },
        { title: 'Trout', points: 5 },
        { title: 'Bass', points: 5 },
        { title: 'Reel', points: 10 },
        { title: 'Line', points: 5 },
        { title: 'Hook', points: 5 },
        { title: 'Bait', points: 10 },
        { title: 'Net', points: 10 },
        { title: 'Waders', points: 15 },
        { title: 'Cast', points: 5 },
        { title: 'Catch and Release', points: 20 },
        { title: 'Fly Fishing', points: 15 },
        { title: 'Catfish', points: 5 },
        { title: 'Carp', points: 5 },
        { title: 'Spinnerbait', points: 10 },
        { title: 'Jig', points: 10 },
        { title: 'Pike', points: 5 },
        { title: 'Walleye', points: 5 },
        { title: 'Crappie', points: 5 },
        { title: 'Trolling', points: 10 },
        { title: 'Chumming', points: 15 },
        { title: 'Swivel', points: 5 },
        { title: 'Leader', points: 5 },
        { title: 'Sinkers', points: 5 },
        { title: 'Bobber', points: 5 },
        { title: 'Plastic Worms', points: 10 },
        { title: 'Topwater Lures', points: 10 },
        { title: 'Fishing Vest', points: 10 },
        { title: 'Depth Finder', points: 15 },
        { title: 'Drift Fishing', points: 10 },
        { title: 'Spoons', points: 5 },
        { title: 'Gaff', points: 10 },
        { title: 'Live Bait', points: 10 },
        { title: 'Artificial Bait', points: 10 },
        { title: 'Barbless Hook', points: 5 },
        { title: 'Fish Finder', points: 15 },
        { title: 'Fishing License', points: 10 },
        { title: 'Fishing Knots', points: 10 },
        { title: 'Ice Fishing', points: 10 },
        { title: 'Surf Fishing', points: 10 },
        { title: 'Trolling Motor', points: 15 },
        { title: 'Fishing Charter', points: 15 },
        { title: 'Fishing Tournament', points: 20 },
        { title: 'Catch Limit', points: 10 },
        { title: 'Filleting Knife', points: 10 },
        { title: 'Marlin', points: 5 },
        { title: 'Tuna', points: 5 },
        { title: 'Mackerel', points: 5 },
        { title: 'Mahi Mahi', points: 10 },
        { title: 'Swordfish', points: 10 },
        { title: 'Snapper', points: 5 },
        { title: 'Grouper', points: 5 },
        { title: 'Fishing Diary', points: 15 },
        { title: 'Tide Chart', points: 10 },
        { title: 'Fishing Etiquette', points: 15 },
        { title: 'Fish Handling', points: 10 },
        { title: 'Fishing Technique', points: 10 }
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
