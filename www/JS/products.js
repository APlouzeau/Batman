document.getElementById("navRessources").classList.add('bg-info');
if (document.querySelector('.role').value == 'Assistant' || document.querySelector('.role').value == 'Comptable') {
    document.querySelector('.catalog').hidden = false;
} else {
    document.querySelector('.buttonProducts').hidden = false;
}

document.querySelector('.addProduct').addEventListener(
    'click', () => {
        document.querySelector('.formAddProducts').hidden = false;
        document.querySelector('.catalog').hidden = true;
},
false,
)
document.querySelector('.showCatalog').addEventListener(
        'click', () => {
        document.querySelector('.formAddProducts').hidden = true;
        document.querySelector('.catalog').hidden = false;

    },
    false,
) 
