document.querySelector('.filtr-text').addEventListener('input', filtujWszystkieKupony )

document.querySelector('.datetime-start').addEventListener('change', filtujWszystkieKupony)

document.querySelector('.datetime-end').addEventListener('change', filtujWszystkieKupony);

[...document.querySelectorAll(".z-filtr-tag-checkbox")].forEach(el => el.addEventListener('change', filtujWszystkieKupony));
[...document.querySelectorAll(".z-filtr-status-checkbox")].forEach(el => el.addEventListener('change', filtujWszystkieKupony));





function filtujWszystkieKupony() {
    const kupony = document.querySelector('.wszystkieKupony').querySelectorAll('.kupon');
    kupony.forEach(filtujKupon);

    console.log("________________________________");
}

function filtujKupon(kupon) {

    let tagsOk = hasTags(kupon);
    let statusOk = hasStatus(kupon);
    let dateStartOk = checkDateStart(kupon)
    let dateEndOk = checkDateEnd(kupon)
    let txtOk = includesText(kupon)
    console.log(kupon.getAttribute("idKuponu"), txtOk,  dateStartOk , dateEndOk, tagsOk , statusOk ,"=> ",(tagsOk && statusOk && dateStartOk && dateEndOk && txtOk) );

    if (tagsOk && statusOk && dateStartOk && dateEndOk && txtOk)
        kupon.classList.remove("display-NONE");
    else
        kupon.classList.add("display-NONE");
}


function includesText(kupon) {
    const requiedTxt = document.querySelector('.filtr-text').value.split(" ");

    let czyZawiera = true;
    requiedTxt.forEach(q => {
        if (!kupon.innerText.toLowerCase().includes(q.toLowerCase())) czyZawiera = false;
    })
    return czyZawiera;

}

function hasTags(kupon) {
    let tagsOk = true;
    document.querySelectorAll('.z-filtr-tag-checkbox').forEach(chBox => {
        if (!hasTag(kupon, chBox)) return tagsOk = false;
    });
    return tagsOk;
}
function hasTag(kupon, tag) {
    if (!tag.checked) return true;
    return kupon.querySelector('.kupons-tags').innerText.includes(tag.name);
}

function checkDateStart(kupon) {
    podanaData = document.querySelector('.datetime-start').value;

    podanaData = podanaData.split("T").join(" ");
    const dataObstawienia = kupon.querySelector('.data-obstawienia').innerText;
    return dataObstawienia >= podanaData;
}

function checkDateEnd(kupon) {
    podanaData = document.querySelector('.datetime-end').value;
    if (podanaData === "") return  true;
    podanaData = podanaData.split("T").join(" ");
    const dataObstawienia = kupon.querySelector('.data-obstawienia').innerText;
    return dataObstawienia <= podanaData;
}

function hasStatus(kupon) {
    statusy = document.querySelectorAll('.z-filtr-status-checkbox');
    let statusKuponu = kupon.querySelector('.status').innerText;

    let ok = false;

    statusy.forEach(s => {
        if (s.checked) {
            if (s.name === statusKuponu.trim()) ok = true
            console.log("status ", s.name,",s kup:", statusKuponu.trim(), s.name === statusKuponu, s.name === statusKuponu.trim());
        }
    })
    return ok;
}



















