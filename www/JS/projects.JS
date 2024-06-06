document.querySelector('.situationButton').addEventListener(
'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.returnSituation').hidden = false;
    document.querySelector('.situation').hidden = false;
    document.querySelector('.return').hidden = false;
},
false,
);

document.querySelector('.orderButton').addEventListener(
    'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.returnOrder').hidden = false;
    document.querySelector('.order').hidden = false;
    document.querySelector('.return').hidden = false;
},
false,
);

document.querySelector('.returnSituation').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.returnSituation').hidden = true;
        document.querySelector('.situation').hidden = true;
},
false,
);

document.querySelector('.returnOrder').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.returnOrder').hidden = true;
        document.querySelector('.order').hidden = true;
},
false,
);