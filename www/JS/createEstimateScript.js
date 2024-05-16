let line = 1;
let block = 2;


let resultQuantity = document.querySelector('.quantity');
resultQuantity.addEventListener('change', () => {
    calcPrice(document.querySelector('#row1'));
})

let resultPrice = document.querySelector(".unitPrice");
resultPrice.addEventListener('change', () => {
    calcPrice(document.querySelector("#row1"));
})

let productLine1 = document.querySelector('.product');
productLine1.addEventListener('change', () => {
    calcPrice(document.querySelector('#row1'));
})

/* let showPriceLine1 = document.querySelector('#row1');
showPriceLine1.addEventListener('change', () => {
    showUnitPrice(document.querySelector('#row1'));
}) */

function showUnitPrice(element) {
    let showUnitPrice = element.querySelector('.unitPrice');
    let searchUnitPrice = element.querySelector('.product');
    showUnitPrice.setAttribute('value', searchUnitPrice.value);
}

// Ok pour ligne ajoutées
function calcPrice(element) {
    let quantity = element.querySelector('.quantity');
    let quantityValue = quantity.value;
    let getPrice = element.querySelector('.unitPrice');
    let priceNumber = getPrice.value;
    let price = quantityValue * priceNumber;
    let resultPrice = element.querySelector('.resultPrice');
    resultPrice.innerText = price;
}


let addBlockEvent = document.querySelector('.addBlock');
addBlockEvent.addEventListener("click", () => {
    addBlock('.block');
})

function select(id) {
    let options = document.getElementById(id);
    let value = [];
    if (id == 'type') {
        for (let i = 0; i < options.children.length; i++) {
            value.push(options.children[i].innerText);
        }
        return value;
    }
    else {
        for (let i = 0; i < options.children.length; i++) {
            let secondValue = [];
            secondValue.push(options.children[i].innerText);
            secondValue.push(options.children[i].value);
            value.push(secondValue);
        }
        return value;
    }
}

function addLine(lineModel, block) {
    const node = document.querySelector(lineModel);
    const clone = node.cloneNode(true);
    cloneLineParams(clone, block);
    clone.classList.remove('rowModel') 
    document.querySelector('.row' + block).appendChild(clone);
}

function addBlock(blockModel) {
    const node = document.querySelector(blockModel);
    const clone = node.cloneNode(true);
    clone.classList.add('block' + block);
    clone.classList.remove('block');
    clone.removeAttribute('id');
    clone.setAttribute('id', 'block' + block);
    clone.removeAttribute('hidden');
    const newDescription = clone.querySelector('.description');
    newDescription.setAttribute('name', 'description' + block + '[]');
    const newTable = clone.querySelector('table');
    newTable.classList.remove('task');
    newTable.removeAttribute('id');
    newTable.classList.add('task' + block);
    const classTbody = clone.querySelector('tbody');
    classTbody.classList.add('row' + block);
    cloneLineParams(clone, block);
    const newAddLineButton = clone.querySelector('.addLineBlock');
    newAddLineButton.classList.remove("addLineBlock");
    newAddLineButton.classList.add('addLineBlock' + block);
    const newTableClass = block;
    newAddLineButton.addEventListener("click", () => {
        addLine('.rowModel', newTableClass);
    })
    const newRow = '#row' + block;
    const selectProductLine1 = clone.querySelector('.product');
    selectProductLine1.addEventListener('change', () => {
        showUnitPrice(clone.querySelector(newRow));
    })
    document.querySelector('.blockList').appendChild(clone);
    block++;
}
    
let showUnitPriceEvent = document.querySelector('.product');
showUnitPriceEvent.addEventListener('change' , () => {
    let shownUnitPrice = document.querySelector('.unitPrice');
    shownUnitPrice.setAttribute('value', showUnitPriceEvent.value);
})

function cloneLineParams(clone, block) {
    const productClone = clone.querySelector('.product');
    productClone.setAttribute('name', 'product' + block + '[]');
    const quantityClone = clone.querySelector('.quantity');
    quantityClone.setAttribute('name', 'quantity' + block + '[]'); 
    quantityClone.setAttribute('required', true);   
    const unitPriceClone = clone.querySelector('.unitPrice');
    unitPriceClone.setAttribute('name', 'unitPrice' + block + '[]');
    unitPriceClone.setAttribute('required', true);
}
