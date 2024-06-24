document.getElementById("navProjects").classList.add('bg-info');

document.querySelector('.situationButton').addEventListener(
'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.resultsButton').hidden = true;
    document.querySelector('.returnSituation').hidden = false;
    document.querySelector('.situation').hidden = false;
    document.querySelector('.returnSituation').hidden = false;
    document.querySelector('.title').innerText = 'Situations';
},
false,
);

document.querySelector('.orderButton').addEventListener(
    'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.resultsButton').hidden = true;
    document.querySelector('.returnOrder').hidden = false;
    document.querySelector('.order').hidden = false;
    document.querySelector('.returnOrder').hidden = false;
    document.querySelector('.title').innerText = 'Commandes';
},
false,
);

document.querySelector('.resultsButton').addEventListener(
    'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.resultsButton').hidden = true;
    document.querySelector('.returnOrder').hidden = false;
    document.querySelector('.results').hidden = false;
    document.querySelector('.returnResults').hidden = false;
    document.querySelector('.title').innerText = 'Résultats';
},
false,
);

document.querySelector('.returnSituation').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.resultsButton').hidden = false;
        document.querySelector('.returnSituation').hidden = true;
        document.querySelector('.situation').hidden = true;
        document.querySelector('.title').innerText = 'Chantiers';
},
false,
);

document.querySelector('.returnOrder').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.resultsButton').hidden = false;
        document.querySelector('.returnOrder').hidden = true;
        document.querySelector('.order').hidden = true;
        document.querySelector('.title').innerText = 'Chantiers';
},
false,
);

document.querySelector('.returnResults').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.resultsButton').hidden = false;
        document.querySelector('.results').hidden = true;
        document.querySelector('.order').hidden = true;
        document.querySelector('.title').innerText = 'Chantiers';
},
false,
);

const selectResults = document.querySelector('.selectEstimateResults')
selectResults.addEventListener('change', () => {
    if (selectResults.options[selectResults.selectedIndex].text != '- -') {
        document.querySelector('.buttonResults').removeAttribute('disabled');
    } else {
        document.querySelector('.buttonResults').setAttribute('disabled', true);
    }
});

const selectOrder = document.querySelector('.selectEstimateOrder')
selectOrder.addEventListener('change', () => {
    if (selectOrder.options[selectOrder.selectedIndex].text != '- -') {
        document.querySelector('.buttonOrder').removeAttribute('disabled');
    } else {
        document.querySelector('.buttonOrder').setAttribute('disabled', true);
    }
});

const selectSituation = document.querySelector('.selectEstimateSituation')
selectSituation.addEventListener('change', () => {
    if (selectSituation.options[selectSituation.selectedIndex].text != '- -') {
        document.querySelector('.buttonSituation').removeAttribute('disabled');
    } else {
        document.querySelector('.buttonSituation').setAttribute('disabled', true);
    }
});