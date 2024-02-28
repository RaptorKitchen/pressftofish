$("body").css("overflow","hidden");

document.addEventListener('DOMContentLoaded', () => {
    const inputField = document.getElementById('inputField');
    const message = document.getElementById('message');
    let gameActive = true;

    inputField.addEventListener('keypress', (event) => {
        if (!gameActive) return;

        if (event.key === 'Enter') {
            const input = inputField.value.trim();
            if (input === 'done' || input === 'finish') {
            //exit game
                gameActive = false;
                inputField.disabled = true;
                return;
            }

            const searchedTerm = $('#inputField').val();
            const element = document.querySelector('#responseField');
            const responseField = document.querySelector('#responseField');
            const isInsideResponseField = responseField.querySelector('#' + searchedTerm);

            if (isInsideResponseField) {
                message.style.opacity = '1';
                message.innerText = isInsideResponseField.textContent;
                setTimeout(() => {
                    message.style.opacity = '0';
                    var elementToRemove = document.getElementById(input);
                    elementToRemove.parentNode.removeChild(elementToRemove);
                    $('.remove-on-press').fadeOut();
                }, 2000);
            } else {
                console.log(searchedTerm + ' not found');
                shakeInput();
                message.innerText = "Hmm, I don't see " + searchedTerm + " today";
                setTimeout(() => {
                    console.log('not found timeout');
                    $(inputField).css('border', 'none');
                }, 2000);
            }
            setTimeout(() => {
                $('#message').empty();
            }, 2000);

            inputField.value = '';
        }
    });
});

function shakeInput() {
    inputField.classList.add('shake');
    setTimeout(() => {
        inputField.classList.remove('shake');
    }, 2000);
}