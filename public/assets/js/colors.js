[...document.querySelectorAll('.input-color-range')].forEach(el => el.addEventListener('change', f));

function f() {
    const box = document.querySelector('.dodaj-tag-picked-color');

    const red = document.querySelector('.input-color-red').value;
    const green = document.querySelector('.input-color-green').value;
    const blue = document.querySelector('.input-color-blue').value;

    const napis = document.querySelector('.dodaj-tag-input-kolor');
    nowyKolor = ("#" + decimalToHex(red) + decimalToHex(green) + decimalToHex(blue) ).toUpperCase();
    napis.value = nowyKolor;
    box.style.backgroundColor = nowyKolor;

}


f();

function decimalToHex(d) {
    var hex = Number(d).toString(16);
    hex = "00".substr(0, 2 - hex.length) + hex;

    return hex;
}