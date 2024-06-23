const selectEstimate = document.querySelector('.selectEstimate');
const selectDriver = document.querySelector('.selectDriver');
const estimateToRegisterButton = document.querySelector('.estimateToRegisterButton');

selectEstimate.addEventListener('change', () => {
    changeButton();
});

selectDriver.addEventListener('change', () => {
    changeButton();
});

function changeButton() {
if (selectEstimate.options[selectEstimate.selectedIndex].text != '- -' && selectDriver.options[selectDriver.selectedIndex].text != '- -') {
    estimateToRegisterButton.removeAttribute('disabled');
} else {
    estimateToRegisterButton.setAttribute('disabled', true);
}
}