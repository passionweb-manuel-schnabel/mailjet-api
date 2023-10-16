let securityTests = {};
let form = document.querySelector('form');
let seconds = 0;
let secondsIntervall = setInterval(incrementSeconds, 1000);
function incrementSeconds() {
    seconds += 1;
    securityTests['seconds'] = seconds;
    if (seconds === 2) {
        setDefaultValues();
    }
    setValue();
    if (seconds >= 90) {
        clearInterval(secondsIntervall);
    }
}

let securityFieldList = Array.from(document.querySelectorAll('form input.security-check-input'));

function setDefaultValues() {
    securityTests['displayWidth'] = screen.width;
    securityTests['displayHeight'] = screen.height;
    securityTests['formRenderedHeight'] = form.offsetHeight;
    securityTests['formRenderedWidth'] = form.offsetWidth;
}

document.addEventListener('scroll', (event) => {
    securityTests['scroll'] = ((securityTests['scroll'] !== undefined) ? securityTests['scroll'] + 1 : 1);
    setValue();
});

document.addEventListener('mousemove', (event) => {
    securityTests['mousemove'] = ((securityTests['mousemove'] !== undefined) ? securityTests['mousemove'] + 1 : 1);
    setValue();
});

document.addEventListener('click', (event) => {
    securityTests['mouseClickX'] = event.screenX;
    securityTests['mouseClickY'] = event.screenY;
    setValue();
});

document.addEventListener('keypress', (event) => {
    if(event.key === "@") securityTests['pressedAT'] = 1;
    if(event.key === " ") securityTests['pressedWhiteSpace'] = 1;
    securityTests['keypress'] = ((securityTests['keypress'] !== undefined) ? securityTests['keypress'] + 1 : 1);
    setValue();
});
function setValue() {
    if (Array.isArray(securityFieldList)){
        securityFieldList.forEach(function(securityField, index, arr){
            securityField.value = JSON.stringify(securityTests);
        });
    }
}
