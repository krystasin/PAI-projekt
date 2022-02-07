[...document.querySelectorAll('.a-dodaj-mecz-filtr-inp')].forEach(el => el.addEventListener('input', flistrujSelecta));

function flistrujSelecta(){
    const query = this.value.split(" ");
    const sel = this.parentNode.querySelector('select');

    console.log(query);
    console.log(sel)
    for (var i = 0, len = sel.options.length; i < len; i++) {
        let czyZawiera = true;
        const mecz = sel.options[i].innerText;

        query.forEach(q => {
            if (!mecz.toLowerCase().includes(q.toLowerCase())) czyZawiera = false;
        })
        sel.options[i].hidden = !czyZawiera;
        sel.options[i].disabled = !czyZawiera;
    }
    sel.selectedIndex = -1;

    for (var i = 0, len = sel.options.length; i < len; i++)
       if(! sel.options[i].hidden )
           return sel.selectedIndex = i;


}


























