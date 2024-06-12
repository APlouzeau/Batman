document.querySelector('.selectEstimate').addEventListener('change', () => {
    const id = document.querySelector('.selectEstimate').value;
    const link = document.querySelector('.link');
    link.href = "views/modifyEstimate.php?id=" + id;
})