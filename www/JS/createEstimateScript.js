let line = 1;
let blockList = document.querySelector('#taskQuantity').value;
let block = blockList;

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

function addLine(lineModel, blockNb) {
    const node = document.querySelector(lineModel);
    const clone = node.cloneNode(true);
    cloneLineParams(clone, blockNb);
    clone.classList.remove('row'); 
    clone.classList.add('row' + blockNb);
    console.log('.task' + blockNb); 
    document.querySelector('.task' + blockNb).appendChild(clone);
}

function addBlock(blockModel) {
    const node = document.querySelector(blockModel);
    const clone = node.cloneNode(true);
    clone.classList.remove('block');
    clone.classList.add('block' + block);
    clone.setAttribute('name', 'lineNb' + block);
    clone.removeAttribute('hidden');
    const tasksNumber = clone.querySelector('.blocNb');
    tasksNumber.setAttribute('name', 'taskNumber' + block);
    tasksNumber.setAttribute('value', block)
    const newDescription = clone.querySelector('.description');
    newDescription.setAttribute('name', 'description' + block);
    newDescription.required = true;
    const classTbody = clone.querySelector('tbody');
    classTbody.classList.remove('task');
    classTbody.classList.add('task' + block);
    cloneLineParams(clone, block);
    const rowClone = clone.querySelector('.row');
    rowClone.classList.remove('row');
    rowClone.classList.add('row' + block);
    const newAddLineButton = clone.querySelector('.addLineBlock');
    newAddLineButton.classList.remove('.addLineBlock');
    newAddLineButton.setAttribute('onclick', 'addLine(\'.row\', ' + block +')');
    console.log('.row, ' + block);
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
    quantityClone.required = true;   
    const unitPriceClone = clone.querySelector('.unitPrice');
    unitPriceClone.setAttribute('name', 'unitPrice' + block + '[]');
    unitPriceClone.required = true;
}
