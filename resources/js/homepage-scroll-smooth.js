import gsap from "gsap";
import { Timeline } from "gsap/gsap-core";
import scrollreveal from "scrollreveal";


const bestPromos = document.querySelector('div.best-promos');
const categories = document.querySelector('div.categories');
const byCategories = document.querySelector('div.by-categories');
const allProduct = document.querySelector('div.all-product');

const [categoriesBtn, ] = Array(categories.querySelectorAll('.category')); 
const [allProducts, ] = Array(allProduct.querySelectorAll('div.product-card'));
const [productsInBestPromos, ] = Array(bestPromos.querySelectorAll('div.product-card'));
const [productByCategories, ] = Array(byCategories.querySelectorAll('div.product-card'));

let toSmooth = [...productsInBestPromos].concat([...categoriesBtn], [...productByCategories], [...allProducts]);


smoothReveal(toSmooth);


function smoothReveal(elements, delay=0, interval=90) {
    elements.forEach(element => {
        scrollreveal().reveal(element, {delay: delay});
        delay += interval*.9;
    })
}