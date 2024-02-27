var videoInput = document.getElementById('inputVideo');
  
var ctracker = new clm.tracker();
ctracker.init();
ctracker.start(videoInput);

async function startWebcam() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        videoInput.srcObject = stream;
        videoInput.play();
    } catch (error) {
        console.error('Error accessing the webcam:', error);
    }
}

function positionLoop() {
    requestAnimationFrame(positionLoop);
    var positions = ctracker.getCurrentPosition();
    // positions = [[x_0, y_0], [x_1,y_1], ... ]
    // do something with the positions ...
  }
  positionLoop();

  var canvasInput = document.getElementById('mirrorCanvas');
  var cc = canvasInput.getContext('2d');
  function drawLoop() {
    requestAnimationFrame(drawLoop);
    cc.clearRect(0, 0, canvasInput.width, canvasInput.height);
    ctracker.draw(canvasInput);
  }
  drawLoop();

function applyFilter() {
    const videoInput = document.getElementById('inputVideo');
    const canvas = document.getElementById('mirrorCanvas');
    const context = canvas.getContext('2d');

    function draw() {
        context.drawImage(videoInput, 0, 0, canvas.width, canvas.height);
        // Apply your artistic filter to the canvas here

        requestAnimationFrame(draw);
    }

    draw();
}

startWebcam();
applyFilter();
