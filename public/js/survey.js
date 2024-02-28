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
                console.log('found');
                message.style.opacity = '1';
                message.innerText = isInsideResponseField.textContent;
                setTimeout(() => {
                    console.log('found timeout');
                    message.style.opacity = '0';
                    var elementToRemove = document.getElementById(input);
                    elementToRemove.parentNode.removeChild(elementToRemove);
                    $('#message').empty();
                }, 2000);
            } else {
                console.log('not found');
                $(inputField).css('border', '2px solid red !important');
                setTimeout(() => {
                    console.log('not found timeout');
                    $(inputField).css('border', 'none');
                }, 2000);
            }

            inputField.value = '';
        }
    });
});
