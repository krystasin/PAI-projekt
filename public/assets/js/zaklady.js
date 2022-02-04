let nrZakladuWForm = 0;
przyciskiWidzoczne = true;

document.querySelector(".dodajNowyKuponPrzycisk").addEventListener("click", function () {
    this.style.display = "none";
    tooglePrzyciski();
    dodajNowyZakladDoForm();
})

document.querySelector(".dodaj-kolejny-zaklad-przycisk").addEventListener("click", function () {
    dodajNowyZakladDoForm();
})


function dodajNowyZakladDoForm() {
    const x = document.querySelector("#nowy-zaklad-template-t").content.children[0].cloneNode(true);

    [...x.querySelectorAll('input')].forEach(el => {
        el.name = `${el.name.split('[')[0]}[${nrZakladuWForm}]`;
        if (!el.classList.contains('nowy-zaklad-input-number'))
            el.value = "";
        else
            el.value = 1.0;
    });

    // usuwanie FORM z zakladem z formularza
    x.querySelector(".usun-zaklad-przycisk").addEventListener("click", function () {
        this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
        const pozostale = document.querySelectorAll('.nowy-zaklad-template-formularz');
        if (pozostale.length == 0) tooglePrzyciski();
    })


    // filtowanie <select> z odzajami zakładów i ich watościami
    x.querySelector(".rodzaj-zaklad-select").addEventListener("change", function () {
        const sel2 = x.querySelector(".wartosc-zaklad-select");
        const val = sel2.options;
        sel2.value = "";
    })


    x.querySelector(".wartosc-zaklad-select").addEventListener("focus", function () {
        this.select
        const sel = x.querySelector(".rodzaj-zaklad-select");
        const wybrany_zaklad = sel.options[sel.selectedIndex];
        //    const sel2 = x.querySelector(".wartosc-zaklad-select");
        for (var i = 0, len = this.options.length; i < len; i++) {
            this.options[i].hidden = this.options[i].value.split("_")[1] != wybrany_zaklad.value;
        }
    })

    x.querySelector('.nz-mecz-filtr').addEventListener("input", function () {
        const query = this.value.split(" ");
        const sel = x.querySelector(".input-mecz");

        console.log(query);
        for (var i = 0, len = sel.options.length; i < len; i++) {
            let czyZawiera = true;
            const mecz = sel.options[i].innerText;

            query.forEach(q => {
                if (!mecz.toLowerCase().includes(q.toLowerCase())) czyZawiera = false;
            })
            sel.options[i].hidden = !czyZawiera;
            sel.options[i].disabled = !czyZawiera;
        }


    })


    document.querySelector(".nowy-zaklad-form").append(x);
    nrZakladuWForm++;
}


// WYSŁANIE FORMULARZU
document.addEventListener("DOMContentLoaded", function () {

    document.querySelector('.nowy-zaklad-button').addEventListener('click', function () {
        const form = document.querySelector('.nowy-zaklad-form');

        const mecz = form.querySelectorAll(".input-mecz");
        const zaklad_r = form.querySelectorAll(".rodzaj-zaklad-select");
        const zaklad_w = form.querySelectorAll(".wartosc-zaklad-select");
        const kurs = form.querySelectorAll(".nowy-zaklad-input-number");
        const status = form.querySelectorAll(".input-status");
        let czyWyjsc = false;
        let tempDataToSent = [];
        for (var i = 0; i < mecz.length; i++) {
            if (zaklad_w[i].value == "") {
                alert("Nie wybrano wartosci zakładu.");
                return czyWyjsc = true;
            }
            nowyZaklad = {
                'mecz': mecz[i].value,
                'zaklad_r': zaklad_r[i].value,
                'zaklad_w': zaklad_w[i].value,
                'kurs': kurs[i].value,
                'status': status[i].value,
            }
            console.log(nowyZaklad);
            tempDataToSent[i] = nowyZaklad;
        }
        if(czyWyjsc)  return;

        const wszystkie_tagi = document.querySelectorAll('.checkbox-tag');
        let wybane_tagi = [];

        wszystkie_tagi.forEach(ch => {
            if (ch.checked) wybane_tagi.push(ch.value)
        });


        const stawka = document.querySelector('.input-stawka').value;
        let dataToSent = {
            'data': tempDataToSent,
            'stawka': stawka,
            'tagi': wybane_tagi
        }
        dataTo = JSON.stringify(dataToSent);

        fetch("/dodajZaklad", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: dataTo
        })
            .then(res => res.json())
            .then(function (res) {
                console.log(res);
                createKupon(res, true);
            })
        document.querySelector(".dodajNowyKuponPrzycisk").style.display = "block";

        [...document.querySelectorAll('.nowy-zaklad-template')].forEach(el => {
            el.remove();
        });
        tooglePrzyciski();


    });
});


function tooglePrzyciski() {
    if (przyciskiWidzoczne) {
        document.querySelector(".dodajNowyKuponPrzycisk").style.display = "none";
        document.querySelector(".nowy-zaklad-form").style.display = "block";
        document.querySelector(".dodaj-kolejny-zaklad-przycisk").style.display = "block";
    } else {
        document.querySelector(".dodajNowyKuponPrzycisk").style.display = "block";
        document.querySelector(".nowy-zaklad-form").style.display = "none";
        document.querySelector(".dodaj-kolejny-zaklad-przycisk").style.display = "none";
    }
    przyciskiWidzoczne = !przyciskiWidzoczne;
}

// WYŚWIETLANIE KUPONU PO DODANIU

function createKupon(kupon_obj, czyNaPoczatku) {

    const zaklady = kupon_obj.zaklady;
    const tagi = kupon_obj.tagi;


    const template = document.querySelector("#kupon-template");

    const kupon = template.content.children[0].cloneNode(true);
    kupon.setAttribute("id", "kupon-" + kupon_obj.id);

    let header = kupon.querySelector(".kupon-header");
    header.querySelector(".kupon-id").innerHTML = "#" + kupon_obj.id;

    header.querySelector(".data-obstawienia").innerHTML = kupon_obj.dataObstawienia.date.slice(0, -10);
    header.querySelector("span").innerHTML = kupon_obj.status;
    header.querySelector("span").classList.add(kupon_obj.status);

    createMid(zaklady, kupon, tagi);
    createBottomTemplate(kupon_obj, kupon)
    if (czyNaPoczatku == true)
        document.querySelector('.wszystkieKupony').prepend(kupon);
    else
        document.querySelector('.wszystkieKupony').append(kupon);
}

function createMid(zaklady, kupon, tagi) {
    let mid = document.querySelector('#kupon-mid-template').content.children[0].cloneNode(true);

    let zakladyDiv = mid.querySelector(".kupon-mid-L");
    console.log(zakladyDiv);
    zaklady.forEach(zaklad => {
        createZaklad(zaklad, zakladyDiv);
    });


    let tagiDiv = mid.querySelector(".kupons-tags");
    tagi.forEach(tag => {
        const p = document.createElement("p");
        p.classList.add("tag");
        p.style.color = tag.kolor;
        p.innerHTML = tag.nazwa;
        tagiDiv.append(p);
    });


    kupon.append(mid);
}

function createZaklad(zaklad, zakladyDiv) {
    const template = document.querySelector("#zaklad-template");
    const zakladDiv = template.content.cloneNode(true);

    zakladDiv.querySelector(".bg-icon-zaklad").classList.add("bg-" + zaklad.status);
    zakladDiv.querySelector(".druzyny").innerHTML = zaklad.gospodarz + " - " + zaklad.gosc;
    zakladDiv.querySelector(".bet").innerHTML = zaklad.rodzajZakladu + ": " + zaklad.wartoscZakladu;
    zakladDiv.querySelector(".data-meczu").innerHTML = zaklad.dataMeczu.date.slice(0, -10);
    zakladDiv.querySelector(".kurs-val").innerHTML = zaklad.kurs;
    zakladyDiv.append(zakladDiv);
}

function createBottomTemplate(kupon_obj, kupon) {

    const template = document.querySelector("#kupon-bottom-template");
    const bottom = template.content.cloneNode(true);
    let kurs_calosc = 1.0;
    kupon_obj.zaklady.forEach(z => {
        kurs_calosc = kurs_calosc * z.kurs;
    });
    bottom.querySelector(".stawka").innerHTML = bottom.querySelector(".stawka").innerHTML + kupon_obj.stawka;
    bottom.querySelector(".kurs").innerHTML = bottom.querySelector(".kurs").innerHTML + kurs_calosc;
    bottom.querySelector(".pot-wygrana").innerHTML = bottom.querySelector(".pot-wygrana").innerHTML + Math.round(kurs_calosc * kupon_obj.stawka.split('$')[1] * 100) / 100;
    // console.log(zaklad.stawka);
    kupon.append(bottom);
}

// WYŚWIETLANIE KUPONU PO DODANIU   -   KONIEC


document.querySelector(".load-more").addEventListener("click", () => {
    const wszystkieKupony = document.querySelector(".wszystkieKupony");
    const kupony = wszystkieKupony.querySelectorAll('.kupon')
    const lastID = {
        'lastID': kupony[kupony.length - 1].querySelector(".kupon-id").innerHTML.slice(1)
    }
    dataToSent = JSON.stringify(lastID);
    console.log(dataToSent);

    fetch("/loadMoreKupons", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataToSent
    })
        .then(res => res.json())
        .then(function (res) {
            console.log(res);
            for (const [key, value] of Object.entries(res).reverse()) {
                createKupon(value, false);
            }

        })


})

















