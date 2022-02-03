document.querySelector(".dodaj-tag-button").addEventListener("click", function () {

    const form = document.querySelector('.tag-calosc-form');

    const nazwa = form.querySelector('.dodaj-tag-input-nazwa').value.trim();
    const aktywny = form.querySelector('.dodaj-tag-input-aktywny').checked;
    const kolor = form.querySelector('.dodaj-tag-input-kolor').value.trim();
    const opis = form.querySelector('.dodaj-tag-input-opis').value;

    const nowyTag = {
        'id': 44,
        'nazwa': nazwa,
        'kolor': kolor,
        'aktywny': aktywny,
        'opis': opis
    }
    console.log(nowyTag);

    if (!validateName(nazwa)) return;




    const nowyTagJson = JSON.stringify(nowyTag);
    console.log(nowyTagJson);

    fetch("/dodajTag", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: nowyTagJson
    })
        .then(res => res.json())
        .then(function (res) {
            createTag(res);
        })


});

function validateName(name) {
    let ret = true;
    if (name === "") ret = false;
    const nazwy = document.querySelector('.wszystkie-tagi').querySelectorAll('.tag-nazwa');
    nazwy.forEach(el => {
        if (el.innerHTML == name)
            return ret = false;
    });

    return ret;
}


function createTag(tag) {
    const template = document.querySelector(".template-tag");
    const tagNode = template.content.children[0].cloneNode(true);

    tagNode.setAttribute("idTagu", tag.id);
    tagNode.setAttribute("iloscUzyc", 0);

    tagNode.querySelector('.tag-nazwa').innerHTML = tag.nazwa;
    tagNode.querySelector('.tag-kolor').innerHTML = tag.kolor;
    tagNode.querySelector('.tag-color-box').style.backgroundColor = tag.kolor;
    tagNode.querySelector('.dodaj-tag-bottom').innerHTML = tag.opis;


    const ch = tagNode.querySelector('.tag-aktywny-checkbox');
    ch.checked = tag.aktywny;

    tagNode.querySelector(".remove-tag").addEventListener("click", function () {
        usunTag(this);
    })
    ch.addEventListener("change", function () {
        zmienAktywnosc(this);
    });

    document.querySelector('.wszystkie-tagi').prepend(tagNode);
}


[...document.querySelectorAll(".tag-aktywny-checkbox")].forEach(el => el.addEventListener("change", function () {
    zmienAktywnosc(this);
}));
[...document.querySelectorAll(".remove-tag")].forEach(el => el.addEventListener("click", function () {
    usunTag(this);
}));

function zmienAktywnosc(el) {
    const id = el.parentNode.parentNode.parentNode.getAttribute("idTagu");
    el.setAttribute("disabled", "disabled");
    console.log(id, el.checked);

    const data = {
        "id": id,
        "value": el.checked
    }

    dataToSend = JSON.stringify(data);


    fetch("/zmienAktywnosc", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataToSend
    })
        .then(res => res.json())
        .then(function (res) {
            if (res.aktywny == false) {
                el.parentNode.children[1].classList.add("nieaktywny-tag");
            } else {
                el.parentNode.children[1].classList.remove("nieaktywny-tag");
            }
            el.removeAttribute("disabled");
        })

}


function usunTag(el) {
    const par = el.parentNode.parentNode;
    const ile = par.getAttribute("iloscuzyc");
    let str = "";
    if (ile > 0) str = "ten tag jest wykoszystywany w " + ile + " kuponach !";
    const answer = window.confirm("na pewno chesz usunać ten tag ?" + str);
    if (!answer) return;

    const data = {
        'id': par.getAttribute("idtagu")
    }
    dataToSend = JSON.stringify(data);


    fetch("/usunTag", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataToSend
    })
        .then(res => res.json())
        .then(function (res) {
            console.log(res);
            par.remove();
        })

}