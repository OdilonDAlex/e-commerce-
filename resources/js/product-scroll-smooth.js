import scrollreveal from "scrollreveal";

const products = document.querySelectorAll('div.container a.product');

smoothReveal(products);

function smoothReveal(elements, delay=0, interval=50) {
    elements.forEach(element => {
        scrollreveal().reveal(element, {delay: delay});
        delay += interval*.9;
    })
}