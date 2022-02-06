[...document.querySelectorAll('.zwin-rozwnin')].forEach(el => el.addEventListener("click", zwinRozwin));


[...document.querySelectorAll('.statystyka')].forEach(pobierzStaty);

function zwinRozwin() {
    const body = this.parentNode.parentNode.parentNode.querySelector('.statystyka-body');
    body.hidden = !body.hidden;
    this.style.backgroundImage = body.hidden ? 'url(/src/img/chevron-circle-down-solid.svg)' : 'url(/src/img/chevron-circle-up-solid.svg)';

}

function pobierzStaty(el){


    const data = {
        'userId': el.getAttribute('userId'),
        'id': el.getAttribute('id'),
    }
    console.log(data);
    const dataJson = JSON.stringify(data);
    console.log(dataJson);

    fetch("/pobierzWybraneZaklady", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: dataJson
    })
        .then(res => res.json())
        .then(function (res) {
            printBody(el, res);
        })

}
function printBody(el, res){
    el.querySelector('.loading-gif').remove();
    res.forEach(row => {
        el.querySelector('.statystyka-body').append(createZakladRow(row));
    });
}


function createZakladRow(row){
    const t = document.querySelector('#stat-zaklad-template-row').content.children[0].cloneNode(true);

    t.querySelector('.stat-id').innerHTML = "#"+row.id;
    t.querySelector('.stat-id').classList.add('stat-' + row.status);
    t.querySelector('.stat-data').innerHTML = row.data.slice(0, -3);
    t.querySelector('.stat-gospodarz').innerHTML = row.gospodarz;
    t.querySelector('.stat-gosc').innerHTML = row.gosc;
    t.querySelector('.stat-zaklad-wartosc').innerHTML = row.zaklad;
    t.querySelector('.stat-kurs').innerHTML = row.kurs;

    return t;
}