
const remainingBudget = document.querySelectorAll('.remainingBudget');
const marges = document.querySelectorAll('.margin');

function changeColor (marges) {
    marges.forEach(element => {
        if (element != "") {
            // element = element.innerText.replace('.', '.');
            console.log(typeof(element));
            if (parseFloat(element.innerText) < 0) {
                element.parentNode.classList.remove('table-warning', 'table-success');
                    element.parentNode.classList.add('table-danger');
                } else if (parseFloat(element.innerText) == 0){
                    element.parentNode.classList.remove('table-danger', 'table-success');
                    element.parentNode.classList.add('table-warning');
                } else if (parseFloat(element.innerText) > 0) {
                    element.parentNode.classList.remove('table-warning', 'table-danger');
                    element.parentNode.classList.add('table-success');
            }
        }
    })
}

changeColor(marges);
changeColor(remainingBudget);
