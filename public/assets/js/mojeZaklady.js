let nrZakladuWForm = 0;


document.querySelector(".dodajNowyZakladPrzycisk").addEventListener("click", function () {
    this.style.display = "none";
    tooglePrzyciski(true);
    dodajNowyZakladDoForm();
})

document.querySelector(".dodaj-kolejny-zaklad-przycisk").addEventListener("click", function () {
    dodajNowyZakladDoForm();
})

function dodajNowyZakladDoForm() {
    const x = document.querySelector(".nowy-zaklad-template").cloneNode(true);
    x.style.display = "flex";

    [...x.querySelectorAll('input')].forEach(el => {
        el.name = `${el.name.split('[')[0]}[${nrZakladuWForm}]`;
        if (!el.classList.contains('nowy-zaklad-input-number'))
            el.value = "";
        else
            el.value = 1.0;
    });

    x.querySelector(".usun-zaklad-przycisk").addEventListener("click", function () {
        this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
        //todo sprwdzić ile zostało w form => tooglePrzyciski();
    })

    x.querySelector(".rodzaj-zaklad-select").addEventListener("change", function () {
        const sel = x.querySelector(".rodzaj-zaklad-select");
        const wybrany_zaklad = sel.options[sel.selectedIndex];
        const sel2 = x.querySelector(".wartosc-zaklad-select");

        console.log("porownianie do: " + wybrany_zaklad.value);


        for (var i = 0, len = sel2.options.length; i < len; i++) {
            opt = sel2.options[i];

            if (opt.value.split("_")[1] != wybrany_zaklad.value) {
                console.log("hide " + opt.value.split("_")[0] + "+" + opt.value.split("_")[1]);
                opt.hidden = true;
            } else {
                console.log("show " + opt.value.split("_")[0] + "+" + opt.value.split("_")[1]);
                opt.hidden = false;

            }
        }
        console.log("______");


        /*        x.querySelector(".wartosc-zaklad-select").options.forEach(
                    o => if(o.value.split("_")[1] != zaklad_rodzaj)
                )*/
    })

    x.querySelector(".rodzaj-zaklad-select").addEventListener("o", function () {

    })




    document.querySelector(".nowy-zaklad-form").append(x);
    nrZakladuWForm++;
}


document.addEventListener("DOMContentLoaded", function () {

    document.querySelector('.nowy-zaklad-button').addEventListener('click', function () {
        const form = document.querySelector('.nowy-zaklad-form');

        const mecz = form.querySelectorAll(".input-mecz");
        const zaklad_r = form.querySelectorAll(".rodzaj-zaklad-select");
        const zaklad_w = form.querySelectorAll(".wartosc-zaklad-select");
        const kurs = form.querySelectorAll(".nowy-zaklad-input-number");
        const status = form.querySelectorAll(".input-status");

        let tempDataToSent = [];
        for (var i = 0; i < mecz.length; i++) {
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
        let dataToSent = {
            'data': tempDataToSent
        }
        console.log(dataToSent);
        dataTo = JSON.stringify(dataToSent);
        console.log(dataTo);
        fetch("/dodajZaklad", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: dataTo
        })
            .then(res => res.json())
            .then(res => console.log(res))

    });
});


function tooglePrzyciski(stan) {
    if (stan == true) {
        document.querySelector(".nowy-zaklad-button").style.display = "block";
        document.querySelector(".dodaj-kolejny-zaklad-przycisk").style.display = "block";
    }
    else{
        document.querySelector(".dodajNowyZakladPrzycisk").style.display = "block";
        document.querySelector(".nowy-zaklad-button").style.display = "none";
        document.querySelector(".dodaj-kolejny-zaklad-przycisk").style.display = "none";
    }

}







