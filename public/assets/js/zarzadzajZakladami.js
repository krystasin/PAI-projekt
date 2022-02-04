


function filtujZaklady(search) {

}


function includesText(kupon) {
    const requiedTxt = document.querySelector('.filtr-text').value.split(" ");

    let czyZawiera = true;
    requiedTxt.forEach(q => {
        if (!kupon.innerText.toLowerCase().includes(q.toLowerCase())) czyZawiera = false;
    })
    return czyZawiera;

}