document.getElementById("navProjects").classList.add('bg-info');

const marges = document.querySelectorAll('.margin');
function changeColor (marges) {
    marges.forEach(element => {
        if (element != "") {
            if (parseFloat(element.innerText) < 0) {
                    element.parentNode.classList.add('table-danger');
                } else if (parseFloat(element.innerText) == 0){
                    element.parentNode.classList.add('table-warning');
                } else if (parseFloat(element.innerText) > 0) {
                    element.parentNode.classList.add('table-success');
            }
        }
    })
}

changeColor(marges);

