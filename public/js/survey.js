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

            const element = document.getElementById(input);
            //word matched
            if (element) {
                message.innerText = element.textContent;
                message.style.opacity = '1';
                setTimeout(() => {
                    message.style.opacity = '0';
                    var elementToRemove = document.getElementById(input);
                    elementToRemove.parentNode.removeChild(elementToRemove);
                }, 2000);
            }

            inputField.value = '';
        }
    });
});
