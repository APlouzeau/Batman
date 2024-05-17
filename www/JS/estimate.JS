document.getElementById("newEstimate").addEventListener(
'click', () => {
    document.getElementById("buttonsEstimate").hidden = true;
    document.getElementById("buttonsCustomer").hidden = false;
    document.getElementById("buttonsBackEstimate").hidden = false;
},
false,
)

document.getElementById("newCustomer").addEventListener(
    'click', () => {
        document.getElementById("buttonsCustomer").hidden = true;
        document.getElementById("formEstimate").hidden = false;
        document.getElementById("buttonsBackNewCustomer").hidden = false;
    },
    false,
    )

document.getElementById("buttonsBackNewCustomer").addEventListener(
    'click', () => {
        document.getElementById("buttonsCustomer").hidden = false;
        document.getElementById("formEstimate").hidden = true;
        document.getElementById("buttonsBackNewCustomer").hidden = true;
        document.getElementById("existantCustomer").hidden = false;
    },
    false,
    )

document.getElementById("buttonsBackEstimate").addEventListener(
    'click', () => {
        document.getElementById("buttonsEstimate").hidden = false;
        document.getElementById("buttonsBackNewCustomer").hidden = false;
        document.getElementById("buttonsCustomer").hidden = true;
    },
    false,
    )