document.getElementById("navRessources").classList.add('bg-info');
if (document.querySelector('.role').value == 'Assistant' || document.querySelector('.role').value == 'Comptable') {
    document.querySelector('.catalog').hidden = false;
} else {
    document.querySelector('.buttonProducts').hidden = false;
}

document.querySelector('.addProduct').addEventListener(
    'click', () => {
        document.querySelector('.formAddProducts').hidden = false;
        document.querySelector('.catalog').hidden = true;
},
false,
)
document.querySelector('.showCatalog').addEventListener(
        'click', () => {
        document.querySelector('.formAddProducts').hidden = true;
        document.querySelector('.catalog').hidden = false;

    },
    false,
);

function verifyName(name) {
    $.ajax({
        url:'/verifyName', //lien vers le fichier de code PHP
        type:'post',    //request method (généralement post)
        async: true,
        data: {name :name.value},
        dataType: 'json',   //
        success: function (results) {
            let danger = document.querySelector('.errorName');
            let border = document.querySelector('#name');
            let createButton = document.querySelector('.createButton');
            if (JSON.parse(results) == false) {
                border.classList.remove('border-success');
                border.classList.add('border-danger');
                danger.innerText = 'Le produit existe déjà';
                danger.classList.remove('text-success');
                danger.classList.add('text-danger');
                danger.hidden = false;
                createButton.setAttribute('disabled', true);
            } else {                
                danger.innerText = 'Le nom de produit est valide';
                border.classList.remove('border-danger');
                border.classList.add('border-success');
                danger.classList.remove('text-danger');
                danger.classList.add('text-success');
                danger.hidden = false;
                createButton.removeAttribute('disabled');
            }
        },
        error:function (request, error) {
        }
    });
}
