let nrZakladuWForm = 0;


document.querySelector(".dodajNowyZakladPrzycisk").addEventListener("click", function () {
    this.style.display = "none";
    document.querySelector(".nowy-zaklad-button").style.display = "block";
    document.querySelector(".dodaj-kolejny-zaklad-przycisk").style.display = "block";
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
                // opt.setAttribute('hiddend');
            } else {
                console.log("show " + opt.value.split("_")[0] + "+" + opt.value.split("_")[1]);
                opt.hidden = false;
                //  opt.removeAttribute('hidden')

            }
        }
        console.log("______");


        /*        x.querySelector(".wartosc-zaklad-select").options.forEach(
                    o => if(o.value.split("_")[1] != zaklad_rodzaj)
                )*/
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

        let dataToSent = new FormData();
        for (var i = 0; i < mecz.length; i++) {
            dataToSent.append('kurs['+i+']', kurs[i]);
            dataToSent.append('status['+i+']', status[i]);
            dataToSent.append('mecz_id['+i+']', mecz[i]);
            dataToSent.append('zaklad_r['+i+']', zaklad_r[i]);
            dataToSent.append('zaklad_w['+i+']', zaklad_w[i]);

        }
        fetch('/dodajZaklad', {
            method: 'POST', body: dataToSent
        })
            .then(res => res.json())
            .then(res => console.log(res))

    });
});










