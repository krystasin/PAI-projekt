const txt = document.querySelector('.filtr-text');
txt.addEventListener('input', function () {

    const query = this.value.split(" ");
    filtrujKupony(query);
})

document.querySelector('.datetime-start').addEventListener('change', function () {
    filtrDate(this.value, true);
})
document.querySelector('.datetime-end').addEventListener('change', function () {
    filtrDate(this.value, false);
})


function filtrujKupony(query) {
    const con = document.querySelector('.wszystkieKupony');
    const kupony = con.querySelectorAll('.kupon');
    console.log(query);
    for (var i = 0, len = kupony.length; i < len; i++) {
        let czyZawiera = true;
        const kuponTxt = kupony[i].innerText;

        query.forEach(q => {
            if (!kuponTxt.toLowerCase().includes(q.toLowerCase())) czyZawiera = false;
        })
        if (czyZawiera)
            kupony[i].style.display = 'block';
        else
            kupony[i].style.display = 'none';

    }
}


function filtrDate(podanaData, filtruj_od) {
    const con = document.querySelector('.wszystkieKupony');
    const kupony = con.querySelectorAll('.kupon');
  //  podanaData.replace('T',' ');
    //todo napawic minuty
    for (var i = 0, len = kupony.length; i < len; i++) {
        let czyZawiera;
        const kupon = kupony[i];
        const dataObstawienia = kupon.querySelector('.data-obstawienia').innerText;

        if (filtruj_od)
            dataObstawienia >= podanaData ? czyZawiera = true : czyZawiera = false;
        else
            dataObstawienia <= podanaData ? czyZawiera = true : czyZawiera = false;

        if (czyZawiera)
            kupon.style.display = 'block';
        else
            kupon.style.display = 'none';
        console.log(dataObstawienia, podanaData, dataObstawienia > podanaData);

    }
}