document.querySelector('.selectEstimate').addEventListener('change', () => {
    const id = document.querySelector('.selectEstimate').value;
    document.querySelector('.estimateButton').removeAttribute('disabled');
});


