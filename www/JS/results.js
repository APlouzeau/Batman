document.getElementById("navProjects").classList.add('bg-info');

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

