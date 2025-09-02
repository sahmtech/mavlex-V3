const screen = document.querySelector('.screen');

function clearScreen() {
    screen.value = '';
}

function deleteChar() {
    screen.value = screen.value.slice(0, -1);
}

function calEnterVal(id) {
    screen.value += id;
}

function calculate() {
    try {
        screen.value = eval(screen.value.replace('÷', '/').replace('x', '*'));
    } catch (e) {
        alert('Invalid Expression');
    }
}
