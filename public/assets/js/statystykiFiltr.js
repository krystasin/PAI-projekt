document.querySelector('.stat-filtr-min-razem').addEventListener('input', filtujWszystkieStatystyki);
document.querySelector('.stat-filtr-max-razem').addEventListener('input', filtujWszystkieStatystyki);
document.querySelector('.stat-filtr-min-wygrane').addEventListener('input', filtujWszystkieStatystyki);
document.querySelector('.stat-filtr-max-wygrane').addEventListener('input', filtujWszystkieStatystyki);
document.querySelector('.stat-filtr-min-przegrane').addEventListener('input', filtujWszystkieStatystyki);
document.querySelector('.stat-filtr-max-przegrane').addEventListener('input', filtujWszystkieStatystyki);


function filtujWszystkieStatystyki(){
    const statystyki = document.querySelector('.content-right').querySelectorAll('.statystyka');

    statystyki.forEach(filtrujStatystyke);
}


function filtrujStatystyke(stat) {
    const minWszystkieOk =  checkMinNawiasy(stat);
    const maxWszystkieOk =  checkMaxNawiasy(stat);

    const minWygraneOK =  checkMin(stat, '.stat-filtr-min-wygrane', '.stat-wygrane');
    const maxWygraneOK =  checkMax(stat, '.stat-filtr-max-wygrane', '.stat-wygrane');

    const minPrzegraneOk =  checkMin(stat, '.stat-filtr-min-przegrane', '.stat-przegrane');
    const maxPrzegraneOk =  checkMax(stat, '.stat-filtr-max-przegrane', '.stat-przegrane');

    console.log (minWszystkieOk , maxWszystkieOk , minWygraneOK , maxWygraneOK , minPrzegraneOk , maxPrzegraneOk)
    if(minWszystkieOk && maxWszystkieOk && minWygraneOK && maxWygraneOK && minPrzegraneOk && maxPrzegraneOk)
        stat.classList.remove("display-NONE");
    else
        stat.classList.add("display-NONE");
}


function checkMinNawiasy(stat){
    const min = document.querySelector('.stat-filtr-min-razem').value;
    const wszystkie = parseInt(stat.querySelector('.stat-wszystkie').innerHTML.slice(1,-1));
    if(min  === "") return true;
    return( min <= wszystkie);
}

function checkMaxNawiasy(stat){
    const max = document.querySelector('.stat-filtr-max-razem').value;
    const wszystkie = parseInt(stat.querySelector('.stat-wszystkie').innerHTML.slice(1,-1));
    if(max  === "") return true;
    return( max >= wszystkie);
}

function checkMin(stat, input, przeszukiwany){
    const min = document.querySelector(input).value;
    const wszystkie = parseInt(stat.querySelector(przeszukiwany).innerHTML);
    console.log(min, wszystkie, min<wszystkie);
    if(min  === "") return true;
    return( min <= wszystkie);
}


function checkMax(stat, input, przeszukiwany){
    const max = document.querySelector(input).value;
    const wszystkie = parseInt(stat.querySelector(przeszukiwany).innerHTML);
    if(max  === "") return true;
    return( max >= wszystkie);
}


