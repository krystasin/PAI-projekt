//stworz pole: kolejna watosc dla zakladu

document.querySelector('.plus-nz-wartosc').addEventListener('click', function () {

    const d = document.querySelector('#zaklad-wartosc');
    const div = d.content.children[0].cloneNode(true);

    div.querySelector('.usun-nz-wartosc').addEventListener('click', function () {
        this.parentNode.remove();
    });
    document.querySelector('.wartosci').append(div);
})


document.querySelector('.save-nowy-zaklad').addEventListener('click', function () {
    const nazwa = document.querySelector('.nz-nazwa').value;
    const watosci_inp = document.querySelectorAll('.nz-wartosc-inp');

    let watosci = [];
    watosci_inp.forEach(w => watosci.push(w.value));


    let dataPrep = {
        'nazwa': nazwa,
        'wartosci': watosci
    }
    dataToSent = JSON.stringify(dataPrep);
    console.log(dataToSent);
    fetch("/stworzZaklad", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataToSent
    })
        .then(res => res.json())
        .then(function (res) {
            if (res.status === true) {
                crateZaklad(res);
            } else {
                alert(res.message);
                // document.querySelector(".message-container").innerHTML = res.message;
            }
        })
        .then(czysc)

});

function czysc() {
    document.querySelector('.nz-nazwa').value = "";
    [...document.querySelectorAll('.nz-zw-row')].forEach(el => el.remove());
}


function crateZaklad(res) {
    const d = document.querySelector('#template-zaklad').content.children[0].cloneNode(true);
    d.setAttribute("id", res.id);
    const header = d.children[0];
    header.setAttribute("id", res.id);
    header.querySelector('.zaklad-id').innerHTML = res.id + '.';
    const inp = header.querySelector('.input-wartosc');
    inp.setAttribute("value", res.rodzaj);
    inp.setAttribute("lastValue", res.rodzaj);
    inp.setAttribute("baseValue", res.rodzaj);


    const wartosciDiv = d.querySelector('.zaklad-wartosci');
    res.wartosci.forEach(w => wartosciDiv.append(crateWartosc(w)));


    document.querySelector('.wszystki-zaklady').append(d);
}

function crateWartosc(w) {
    const d = document.querySelector('#template-single-wartosc').content.children[0].cloneNode(true);
    d.setAttribute("id", w.id)
    d.querySelector('.zaklad-wartosc-id').setAttribute("id", w.id);
    const inp = d.querySelector('.input-wartosc');
    inp.setAttribute("value", w.wartosc);
    inp.setAttribute("lastValue", w.wartosc);
    inp.setAttribute("baseValue", w.wartosc);

    return d;
}


document.querySelector('.zaklady-search').addEventListener("input", filtuj);

function filtuj() {
    const zaklady = document.querySelector('.wszystki-zaklady').querySelectorAll('.zaklad');
    zaklady.forEach(filtujZaklad)
}

function filtujZaklad(zaklad) {

    let v1 = includesText(zaklad);
    if (v1)
        zaklad.style.display = 'flex';
    else
        zaklad.style.display = 'none';


}

function includesText(zaklad) {

    let searched = document.querySelector('.zaklady-search').value.split(" ");
    let czyZawiera = false;

    searched.forEach(q => {
        const inputy = zaklad.querySelectorAll('input');

        inputy.forEach(inp => {

            if (inp.value.toLowerCase().includes(q.toLowerCase())) {
                czyZawiera = true;
            }
        })

    })
    return czyZawiera;
}


[...document.querySelectorAll('.usun')].forEach(el => el.addEventListener("click", usun));
[...document.querySelectorAll('.undo')].forEach(el => el.addEventListener("click", undo));
[...document.querySelectorAll('.save')].forEach(el => el.addEventListener("click", save));

[...document.querySelectorAll('.input-wartosc')].forEach(el => el.addEventListener("input", function () {
    //  this.parentNode.querySelector('.undo').style.backgroundColor = 'black';
    this.parentNode.querySelector('.save').style.backgroundColor = 'black';
}));

//todo
function usun() {
    alert("opcja obecnie niedostępna");
}

//todo
function undo() {
    if (this.getAttribute("active") == 'false') {
        return;
    }
    this.style.backgroundColor = '#666';
    const node = this.parentNode;
    const save = node.querySelector('.save');
    const input = node.querySelector('.input-wartosc');

    save.style.backgroundColor = 'black';
    save.setAttribute("active", 'true');
    input.value = input.getAttribute("lastValue");

}

//todo
function save() {

    const node = this.parentNode;
    const input = node.querySelector('.input-wartosc');

    const undo = node.querySelector('.undo');
    if (input.value === input.getAttribute("baseValue")) {
        undo.style.backgroundColor = '#666';
        undo.setAttribute('active', false);

        undo.setAttribute('active', false);
        this.style.backgroundColor = "#666";
        return
    }
    ;
    if (!window.confirm("na pewno chesz usunać tą wartość ?")) return;


    this.setAttribute('active', false);

    this.style.backgroundColor = '#333';
    undo.style.backgroundColor = 'black';
    undo.setAttribute('active', true);

    const lastValue = input.getAttribute("lastValue");
    const baseValue = input.getAttribute("baseValue");
    input.setAttribute('lastValue', baseValue);
    input.setAttribute('baseValue', input.value);
    input.setAttribute('value', input.value);
    //  this.value =


    const zakladId = node.parentNode.parentNode.getAttribute("id");
    const wartoscId = node.getAttribute("id");
    const wartoscZ = input.value;

    const dataPrep = {
        'zakladId': zakladId,
        'wartoscId': wartoscId,
        'wartosc': wartoscZ
    }
    dataToSend = JSON.stringify(dataPrep);
    console.log(dataToSend);

    const href = this.getAttribute('href');
    fetch("/" + href, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataToSend
    })
        .then(res => res.json())
        .then(console.log)

}
