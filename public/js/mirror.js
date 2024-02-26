async function startWebcam() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        const videoElement = document.getElementById('webcam');
        videoElement.srcObject = stream;
        videoElement.play();
    } catch (error) {
        console.error('Error accessing the webcam:', error);
    }
}

function applyFilter() {
    const videoElement = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    function draw() {
        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
        // Apply your artistic filter to the canvas here

        requestAnimationFrame(draw);
    }

    draw();
}

startWebcam();
applyFilter();
