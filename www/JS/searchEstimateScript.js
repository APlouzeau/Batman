document.querySelector('.selectEstimate').addEventListener('change', () => {
    const id = document.querySelector('.selectEstimate').value;
    console.log(id);
    const link = document.querySelector('.link');
    link.href = "views/modifyEstimate.php?id=" + id;
})