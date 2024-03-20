let line = 1;

let resultQuantity = document.querySelector("#quantity");
resultQuantity.addEventListener('change', () => {
    calcPrice(document.querySelector("#firstRow"));
})

let resultPrice = document.querySelector("#unitPrice");
resultPrice.addEventListener('change', () => {
    calcPrice(document.querySelector("#firstRow"));
})

let addLineEvent = document.querySelector('#addLine');
addLineEvent.addEventListener("click", () => {
    addLine('estimate');
})

function calcPrice(element) {
    let quantity = element.querySelector(".quantity");
    let quantityValue = quantity.value;
    let getPrice = element.querySelector(".unitPrice");
    let priceNumber = getPrice.value;
    let price = quantityValue * priceNumber;
    let resultPrice = element.querySelector('.resultPrice');
    resultPrice.innerText = price;   
}


function select(id) {
    let options = document.getElementById(id);
    let value = [];
    if (id == 'poste') {
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

function showPrice(element) {
    let showUnitPrice = element.querySelector('.unitPrice');
    let searchUnitPrice = element.querySelector('.product');
    console.log(searchUnitPrice.value);
    showUnitPrice.setAttribute('value', searchUnitPrice.value);
}

function addLine(tableId) {  
    // Récupération d'une référence à la table
    let refTable = document.getElementById(tableId);
    
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
    let arrayOptionsPoste = select('poste');
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
        console.log('coucou');
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
    
let showUnitPriceEvent = document.querySelector('#product');
showUnitPriceEvent.addEventListener('change' , () => {
    let shownUnitPrice = document.querySelector('.unitPrice');
    shownUnitPrice.setAttribute('value', showUnitPriceEvent.value);
})
        
