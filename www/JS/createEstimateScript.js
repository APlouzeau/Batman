document.getElementById("navEstimate").classList.add('bg-info');

let line = 1;
let blockList = document.querySelector('#taskQuantity').value;
let block = blockList;
let rowCount = document.querySelector('#rowCount').value;

let arrayClass = document.getElementsByClassName('rowId');
arrayId = [];
for (let i = 0; i < arrayClass.length; i++) {
    arrayId.push(arrayClass[i]['id']);
};
arrayId.forEach(element => {
    const rowSelected = document.querySelector('.row' + element);
    const resultQuantity = rowSelected.querySelector('.quantity');
    resultQuantity.addEventListener('input', () => {
        calcPrice(rowSelected);
    });
    const resultUnitPrice = rowSelected.querySelector('.unitPrice');
    resultUnitPrice.addEventListener('input', () => {
        calcPrice(rowSelected);
    });    
    const removeLine = rowSelected.querySelector('.remove');
    removeLine.addEventListener('click', () => {
        remove(rowSelected);
    });
    const showUnitPriceSelector = rowSelected.querySelector('.product');
    showUnitPriceSelector.addEventListener('change', () => {
        showUnitPrice(rowSelected);
        showUnit(rowSelected);
        calcPrice(rowSelected);
    });
    const showProductsFromTypeSelected = rowSelected.querySelector('.type');
    showProductsFromTypeSelected.addEventListener('change', () => {
        showProductsFromType(rowSelected);
    });
});

const blockClass = document.getElementsByClassName('blockId');
arrayBlockClassId = [];
for (let i = 0; i < blockClass.length; i++) {
    arrayBlockClassId.push(blockClass[i]['id']);
};
console.log(arrayBlockClassId);
arrayBlockClassId.forEach(element => {
    const blockSelected = document.querySelector('.' + element);
    const removeBlock = blockSelected.querySelector('.removeBlock');
    removeBlock.addEventListener('click', () => {
        remove(blockSelected);
    })
});

function showProductsFromType(rowSelected) {
    const arrayType = rowSelected.querySelectorAll('[data-gettype]');
    const typeSelector = rowSelected.querySelector('.type');
    const showSelectFromType = rowSelected.querySelector('.product');
    const type = typeSelector.options[typeSelector.selectedIndex].dataset.settype;
    arrayType.forEach(element => {
        if (element.dataset.gettype == type) {
            element.removeAttribute('hidden');
        } else {
            element.setAttribute('hidden', true);
        }        
    });
}

function showUnit(rowSelected) {
    const searchUnit = rowSelected.querySelector('.product');
    const showUnit = rowSelected.querySelector('.unit');
    const saveUnit = rowSelected.querySelector('.unitName');
    const unit = searchUnit.options[searchUnit.selectedIndex].dataset.getunit;
    showUnit.innerText = unit;
    saveUnit.setAttribute('value', unit);

}

function calcPrice(rowSelected) {
    let quantity = rowSelected.querySelector('.quantity');
    let quantityValue = quantity.value;
    let getPrice = rowSelected.querySelector('.unitPrice');
    let priceNumber = getPrice.value;
    let price = quantityValue * priceNumber;
    price = price.toFixed(2);
    let resultPrice = rowSelected.querySelector('.resultPrice');
    resultPrice.innerText = price;
}

function showUnitPrice(rowSelected) {
    let searchUnitPrice = rowSelected.querySelector('.product');
    let showUnitPrice = rowSelected.querySelector('.unitPrice');
    let price = searchUnitPrice.options[searchUnitPrice.selectedIndex].dataset.getprice;
    showUnitPrice.setAttribute('value', price);
}

function remove(rowSelected) {
    console.log('remove appelée');
    rowSelected.remove();
}

// Ok pour ligne ajoutées
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
    const table = document.querySelector('.table' + blockNb);
    const row = table.rows.length;
    const clone = node.cloneNode(true);
    const unitName = clone.querySelector('.unitName');
    unitName.setAttribute('name', 'unit' + blockNb + '[]');
    const rowNb = clone.querySelector('.rowNb');
    rowNb.setAttribute('name', 'row' + blockNb + '[]');
    rowNb.setAttribute('value', row);
    cloneLineParams(clone, blockNb);
    clone.classList.remove('row'); 
    clone.classList.add('row' + blockNb + row);
    const newRow = '.row' + blockNb + row;
    const removeButton = clone.querySelector('.remove');
    removeButton.addEventListener('click', () => {
        remove(document.querySelector(newRow));
    });
    const resultPriceProduct = clone.querySelector('.unitPrice');
    resultPriceProduct.addEventListener('input', () => {
        calcPrice(document.querySelector(newRow));
    });
    const resultPriceQuantity = clone.querySelector('.quantity');
    resultPriceQuantity.addEventListener('input', () => {
        calcPrice(document.querySelector(newRow));
    });  
    const showUnitPriceSelector = clone.querySelector('.product');
    showUnitPriceSelector.addEventListener('change', () => {
        showUnitPrice(document.querySelector(newRow));
        showUnit(document.querySelector(newRow));
        calcPrice(document.querySelector(newRow));
    });
    const showProductsFromTypeSelected = clone.querySelector('.type');
    showProductsFromTypeSelected.addEventListener('change', () => {
        showProductsFromType(document.querySelector(newRow));
    });
    document.querySelector('.task' + blockNb).appendChild(clone);
}

function addBlock(blockModel) {
    const node = document.querySelector(blockModel);
    const clone = node.cloneNode(true);
    clone.classList.remove('block');
    clone.classList.add('block' + block);
    clone.setAttribute('name', 'lineNb' + block);
    clone.removeAttribute('hidden');
    const table = clone.querySelector('.table');2
    table.classList.add('table' + block);
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
    rowClone.classList.add('row' + block + '1');
    const rowNb = clone.querySelector('.rowNb');
    rowNb.setAttribute('name', 'row' + block + '[]');
    rowNb.setAttribute('value', '1');
    const newAddLineButton = clone.querySelector('.addLineBlock');
    newAddLineButton.classList.remove('.addLineBlock');
    newAddLineButton.setAttribute('onclick', 'addLine(\'.row\', ' + block +')');
    const unitName = clone.querySelector('.unitName');
    unitName.setAttribute('name', 'unit' + block + '[]');
    const newRow = '.row' + block + 1; 
    const removeBlock = clone.querySelector('.removeBlock');
    removeBlock.addEventListener('click', () => {
        remove(clone);
    })
    const selectProductLine1 = clone.querySelector('.product');
    selectProductLine1.addEventListener('change', () => {
        showUnitPrice(clone.querySelector(newRow));
        calcPrice(document.querySelector(newRow));
        showUnit(clone.querySelector(newRow));
    });
    const showProductsFromTypeSelected = clone.querySelector('.type');
    showProductsFromTypeSelected.addEventListener('change', () => {
        showProductsFromType(clone.querySelector(newRow));
    });
    addCalcPriceFunction(clone, newRow);
    document.querySelector('.blockList').appendChild(clone);
    block++;
}

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

function addCalcPriceFunction(clone, newRow) {
    const resultPriceProduct = clone.querySelector('.unitPrice');
    resultPriceProduct.addEventListener('input', () => {
        calcPrice(clone.querySelector(newRow));
    });
    const resultPriceQuantity = clone.querySelector('.quantity');
    resultPriceQuantity.addEventListener('input', () => {
        calcPrice(clone.querySelector(newRow));
    });  
}
