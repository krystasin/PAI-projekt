let nrZakladuWForm = 0;

document.querySelector(".dodajNowyZakladPrzycisk").addEventListener("click", function () {
    this.style.display = "none";
    document.querySelector(".nowy-zaklad-button").style.display = "block";
    document.querySelector(".dodaj-kolejny-zaklad-przycisk").style.display = "block";
    f();
})


document.querySelector(".dodaj-kolejny-zaklad-przycisk").addEventListener("click",     function () {
    this.style.color = "green";
    f();
})

function f(){
    const x = document.querySelector(".nowy-zaklad-template").cloneNode(true);
    x.style.display = "flex";

    [...x.querySelectorAll('input')].forEach(el => {
        el.name = `${el.name.split('[')[0]}[${nrZakladuWForm}]`;
        el.value = "";
        console.log(el);
    });
    x.querySelector(".usun-zaklad-przycisk").addEventListener("click", function () {
        this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
    })

//  todo update datameczu na podstawie meczu
    x.querySelector(".input-mecz").addEventListener("input", function () {
      //  this.parentNode.querySelector(".label-mecz").innerHTML = this.value;      todo to remove
    })

    document.querySelector(".nowy-zaklad-form").append(x);
    nrZakladuWForm++;
}









