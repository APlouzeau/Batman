console.log('saucisson');
document.getElementById("newEstimate").addEventListener(
'click', () => {
    document.getElementById("buttonsEstimate").hidden = true;
    document.getElementById("buttonsCustomer").hidden = false;
},
false,
)

document.getElementById("newCustomer").addEventListener(
    'click', () => {
        document.getElementById("buttonsCustomer").hidden = true;
        document.getElementById("formEstimate").hidden = false;
    },
    false,
    )
