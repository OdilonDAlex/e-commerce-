import axios from "axios";
import { Prompt } from "./models";
import { Alert } from "./models";


const addToCartForms = document.querySelectorAll('div.product-card div.image form, a.product div.action form');

const cartItemsCount = document.querySelector('header ul.nav li.nav-item span.cart-items-count');
const notificationItemsCount = document.querySelector('header ul.nav li.nav-item span.notification-count');
var section = document.querySelector('section.content') ;

if(cartItemsCount !== null) {
    if(cartItemsCount.innerText == '0') {
        cartItemsCount.style.display = 'none' ;
        cartItemsCount.innerText = 0;
    }
    
    if(notificationItemsCount.innerText == '0') {
        notificationItemsCount.style.display = 'none' ;
        notificationItemsCount.innerText = 0;
    }
}

addToCartForms.forEach(form => {
    
    let productId = form.elements.product_id.value;

    form.addEventListener('submit', (event) => {
        event.preventDefault() ;

        let alert_ = new Alert('Votre demande est en cours de traitement...');
        
        let prompt = new Prompt('Ajout de produit', 'Quantité de produit', 'Confirmer', 'Annuler') ;

        let productCardContainer = form.parentNode.parentNode.parentNode ;

        productCardContainer.appendChild(prompt.htmlElement) ;

        prompt.htmlElement.querySelector('form input[type="number"]');
        (async function() {
            return await new Promise((resolve, reject) => {
                let form = prompt.htmlElement.querySelector('form') ;
                let cancelBtn = form.querySelector('button');

                form.addEventListener('submit', (ev) => {
                    ev.preventDefault() ;

                    prompt.htmlElement.parentNode.removeChild(prompt.htmlElement) ;
                    resolve(form.quantity.value) ;
                })

                cancelBtn.addEventListener('click', (ev) => {
                    reject(-1) ;
                })
            }) ;
        })()
        .then( ( quantity ) => {
            if(quantity > 0) {
                let data = {
                    product_id: productId,
                    quantity: quantity
                }
        
                axios.post('../cart/add', data)
                .catch( (error) => {
                    console.error(error);
                });
    
                alert_.insertBefore(section) ;
                
                setTimeout( () => {
                    let stock = productCardContainer.querySelector('.stock')
                    let newStock = parseInt(stock.innerText) - quantity;
                    if(newStock > 0){
                        stock.innerText = `${newStock} disponible(s)`;
                    }
                    else {
                        stock.innerHTML = 'en rupture de stock';
                    }
                }
                , 500);
                
            }
        })
    })
});