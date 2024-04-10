const gridSize = 10;
const focusWords = ["RESOLVE", "FORTITUDE", "FOCUS", "STRENGTH"];
const fleeWords = ["HOME", "SAFETY", "FREEDOM", "CABIN", "REPRIEVE"];
let grid = [];
let timeLeft = 60;

function updateTimer() {
    const timerElement = document.getElementById('time');
    timerElement.textContent = timeLeft;
    if (timeLeft > 0) {
        timeLeft--;
        setTimeout(updateTimer, 1000);
    } else {
        alert('Time is up!');
        // TODO: End game
    }
}
  
function randomizeLetters() {
    const gridItems = document.querySelectorAll('.grid-item');
    gridItems.forEach((item, index) => {
        const row = Math.floor(index / gridSize);
        const col = index % gridSize;
        if (!words.some(word => word.includes(grid[row][col]))) {
            // Randomize the letter if it's not part of a word
            const randomLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
            item.textContent = randomLetter;
        }
    });
}

function initializeGrid(focusOrFlee) {
    $("#wordTimer").show();
    grid = new Array(gridSize).fill(0).map(() => new Array(gridSize).fill('-'));
    const wordsAvailable = (focusOrFlee == 'flee') ? fleeWords : focusWords;
  
    // Randomly select a word
    const selectedWord = wordsAvailable[Math.floor(Math.random() * wordsAvailable.length)];
  
    // Find a valid starting position for the word
    let validPositionFound = false;
    let row, col;
  
    while (!validPositionFound) {
      row = Math.floor(Math.random() * gridSize);
      col = Math.floor(Math.random() * (gridSize - selectedWord.length + 1)); // Adjust to ensure word fits
  
      // Check if the word can be placed without spilling over into the next row
      if (col + selectedWord.length <= gridSize) {
        validPositionFound = true;
      }
    }
  
    // Insert the word into the grid
    for (let i = 0; i < selectedWord.length; i++) {
        grid[row][col + i] = selectedWord[i];
    }

    initializeGrid();
    updateTimer();
    setInterval(randomizeLetters, 3000);
}

function showModal(focusOrFlee) {
    //TODO: focusOrFlee and success/failure determines language / imagery here
    let modal = document.getElementById('fullPageModal');
    let resultText = document.getElementById('resultText');
    let html = '<div class="container text-center">';
        html += '<div class="row">';
            html += '<div class="col-12">';
                // TODO: update language depending on focus/flee and success/fail
                html += '<h1>Congratulations!</h1>';
                html += '<hr>';
            html += '</div>';
        html += '</div>';
        html += '<div class="row">';
            // TODO: update imagery depending on focus/flee and success/fail
            html += '<div class="col-12"><img class="" src="../images/snowy-sunset.jpg" width="100%"/></div>';
            html += '<div class="col-12">';
                // TODO: update language depending on focus/flee and success/fail
                html += '<p>Satisfied with your catch, you begin to make preparations to return to your boat. In the diminished light of the setting sun, you observe an unatural glow near the mountaintop.</p>';
                html += '<p>You are compelled to investigate it.</p>';
            html += '</div>';
        html += '<div class="row">';
            html += '<div class="col-12">';
                // TODO: update language depending on focus/flee and success/fail
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