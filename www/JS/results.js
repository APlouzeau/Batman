document.getElementById("navProjects").classList.add('bg-info');

const marges = document.querySelectorAll('.margin');
console.log(marges);
function changeColor (marges) {
    marges.forEach(element => {
        if (element != "") {
            console.log(element.innerText);
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

