let currentQuestionId;

function fetchQuestion() {
    fetch('/get-question')
        .then(response => response.json())
        .then(data => {
            currentQuestionId = data.id;
            document.getElementById('question-label').innerText = data.label;
        });
}

function submitAnswer() {
    const answer = document.getElementById('answer-input').value;

    fetch('/submit-answer', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            question_id: currentQuestionId,
            answer: answer
        })
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            fetchQuestion(); // Fetch next question
        });
}

// Initial fetch
fetchQuestion();