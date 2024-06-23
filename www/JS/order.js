document.getElementById("navProjects").classList.add('bg-info');

const arrayClassQuantity = document.getElementsByClassName('quantity');
let arrayClassQuantityId = [];
const arrayClassUnitPrice = document.getElementsByClassName('unitPrice');
let arrayClassUnitPriceId = [];
const arrayClassOrder = document.getElementsByClassName('order');
let arrayClassOrderId = [];
const arrayClassRow = document.getElementsByClassName('rowId');
let arrayClassRowId = [];

for (let i = 0; i < arrayClassQuantity.length; i++) {
    if (arrayClassQuantity[i]['id'] != '') {
        arrayClassQuantityId.push(arrayClassQuantity[i]['id']);
        arrayClassUnitPriceId.push(arrayClassUnitPrice[i]['id']);
        arrayClassOrderId.push(arrayClassOrder[i]['id']);
        arrayClassRowId.push(arrayClassRow[i]['id']);
    }
};
function calcPrice(element) {
    const unitSelector = element.querySelector('.product');
    const unit = unitSelector.options[unitSelector.selectedIndex].dataset.unit;
    const resultPrice = element.querySelector('.order');
    const quantity = element.querySelector('.quantity');
    let quantityValue = quantity.value;
    const classOrder = element.querySelector('.orderInput');
    if (unit == 'h') {
        resultPrice.innerText = Number.parseFloat(quantityValue).toFixed(2);
        classOrder.value = Number.parseFloat(quantityValue).toFixed(2);
    } else {
        const getPrice = element.querySelector('.unitPrice');
        let priceNumber = getPrice.value;
        let price = Number.parseFloat(quantityValue * priceNumber).toFixed(2);
        resultPrice.innerText = price;
        classOrder.value = price;
        return price;
    }
}

function changeColor (arrayClassId) {
    arrayClassId.forEach(element => {
        if (element != "") {
            const query = document.getElementById(element);
            query.addEventListener('input', () => {
                if (query.value == '') {
                    query.classList.remove('bg-success');
                    query.classList.add('bg-danger');
                } else {
                    query.classList.remove('bg-danger');
                    query.classList.add('bg-success');
                }    
            })
            }
    })
}

function priceColor (rowId) {
    rowId.forEach(element => {
        if (element != "") {
            const rowSelected = document.querySelector('.row' + element);
            const resultQuantity = rowSelected.querySelector('.quantity');
            resultQuantity.addEventListener('change', () => {
                price = calcPrice(rowSelected);  
                changeColorPrice(price, rowSelected);              
            });
            const resultUnitPrice = rowSelected.querySelector('.unitPrice');
            resultUnitPrice.addEventListener('change', () => {
                price = calcPrice(rowSelected);
                changeColorPrice(price, rowSelected);
            });
        }
    });
}

function changeColorPrice(price, rowSelected) {
    const priceSelled = rowSelected.querySelector('.resultPrice');
    const newPrice = rowSelected.querySelector('.order');
    const alreadyBuy = rowSelected.querySelector('.alreadyBuy');
    if (price > (priceSelled.value - alreadyBuy.value)) {
        newPrice.classList.remove('bg-success');
        newPrice.classList.add('bg-danger');
    } else {
        newPrice.classList.remove('bg-danger');
        newPrice.classList.add('bg-success');
    }
}

priceColor(arrayClassRowId);
changeColor(arrayClassQuantityId);
changeColor(arrayClassUnitPriceId);
changeColor(arrayClassOrderId);
