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

let showPriceLine1 = document.querySelector('#row1');
showPriceLine1.addEventListener('change', () => {
    showPrice(document.querySelector('#row1'));
})

function showPrice(element) {
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

let addLineEvent = document.querySelector('.addLineBlock1');
addLineEvent.addEventListener("click", () => {
    addLine('.task1');
})

let addBlockEvent = document.querySelector('.addBlock');
addBlockEvent.addEventListener("click", () => {
    addBlock('.blockModel');
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

function addBlock(blockModel) {
    const node = document.querySelector(blockModel);
    const clone = node.cloneNode(true);
    clone.classList.add('block' + block);
    clone.removeAttribute('hidden');
    const newTable = clone.querySelector('table');
    newTable.removeAttribute('id');
    newTable.classList.add('task' + block);
    const idLine = clone.querySelector('#row');
    idLine.setAttribute('id', 'row' + block);
    const newAddLineButton = clone.querySelector('.addLineBlock');
    newAddLineButton.classList.remove("addLineBlock");
    newAddLineButton.classList.add('addLineBlock' + block);
    const newTableClass = '.task' + block;
    newAddLineButton.addEventListener("click", () => {
    addLine(newTableClass);
})
    const newRow = '#row' + block;
    const selectProductLine1 = clone.querySelector('.product');
    selectProductLine1.addEventListener('change', () => {
        showPrice(clone.querySelector(newRow));
    })
    document.querySelector('.blockList').appendChild(clone);
    block++;
}

function addLine(tableId) {  
    // Récupération d'une référence à la table
    let refTable = document.querySelector(tableId);
    
    // Insère une ligne dans la table à l'indice de ligne 0
    let newLine = refTable.insertRow(-1);
    
    // Insère une cellule dans la ligne à l'indice 0
    let newCasePoste = newLine.insertCell(-1);
    let newCaseProduct = newLine.insertCell(-1);
    let newCaseQuantity = newLine.insertCell(-1);
    let newCaseUnitPrice = newLine.insertCell(-1);
    let newCaseTotalPrice = newLine.insertCell(-1);
    
    // Ajoute un nœud texte à la cellule
    let newCasePosteSelect = document.createElement('select');
    newCasePosteSelect.classList.add('form-select');
    let arrayOptionsPoste = select('type');
    arrayOptionsPoste.forEach(element => {
        let newCasePosteSelectOptions = document.createElement('option');
        newCasePosteSelectOptions.text = element;
        newCasePosteSelect.appendChild(newCasePosteSelectOptions);
    });
    
    let newCaseProductSelect = document.createElement('select');
    newCaseProductSelect.classList.add('form-select', 'product');
    let arrayOptionsProduct = select('product');
    arrayOptionsProduct.forEach(element => {
        let newCaseProductSelectOptions = document.createElement('option');
        newCaseProductSelectOptions.value = element[1];
        newCaseProductSelect.appendChild(newCaseProductSelectOptions);
        newCaseProductSelectOptions.text = element[0];
    });
    newCaseProductSelect.addEventListener('change', () => {
        showPrice(newLine);
        });
        
    let newCaseQuantityContent = document.createElement('input');
    newCaseQuantityContent.classList.add('form-control', 'quantity');
    newCaseQuantityContent.setAttribute('id', 'quantity' + line);
    newCaseQuantityContent.addEventListener('change', () => {
        calcPrice(newLine);
    });
        
        
    let newCaseUnitPriceContent = document.createElement('input');
    newCaseUnitPriceContent.classList.add('form-control', 'unitPrice');
    newCaseUnitPriceContent.setAttribute('id', 'unitPrice' + line);
    newCaseUnitPriceContent.addEventListener('change', () => {
        calcPrice(newLine);
    });
        
    let newCaseTotalPriceContent = document.createElement('div');
    newCaseTotalPriceContent.classList.add('resultPrice');
    newCaseTotalPriceContent.setAttribute('id', 'totalPrice' + line)
    newCaseTotalPriceContent.value = 0;
    
    newCasePoste.appendChild(newCasePosteSelect);
    newCaseProduct.appendChild(newCaseProductSelect);
    newCaseQuantity.appendChild(newCaseQuantityContent);
    newCaseUnitPrice.appendChild(newCaseUnitPriceContent);
    newCaseTotalPrice.appendChild(newCaseTotalPriceContent);
      
    line++;
};
    
let showUnitPriceEvent = document.querySelector('.product');
showUnitPriceEvent.addEventListener('change' , () => {
    let shownUnitPrice = document.querySelector('.unitPrice');
    shownUnitPrice.setAttribute('value', showUnitPriceEvent.value);
})
