/* const arrayClassProducts = document.getElementsByClassName('product');
const arrayProductsId = [];

for (let i = 0; i < arrayClassProducts.length; i++) {
    if (arrayClassProducts[i]['id'] != '') {
        arrayProductsId.push(arrayClassProducts[i]['id']);
    };
};
 */

const marges = document.querySelectorAll('.margin');
function changeColor (marges) {
    marges.forEach(element => {
        if (element != "") {
            if (parseFloat(element.innerText) < 0) {
                    element.parentNode.classList.add('list-group-item-danger');
                } else if (parseFloat(element.innerText) == 0){
                    element.parentNode.classList.add('list-group-item-warning');
                } else if (parseFloat(element.innerText) > 0) {
                    element.parentNode.classList.add('list-group-item-success');
            }
        }
    })
}

changeColor(marges);

