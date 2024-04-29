import axios from "axios";
var baseUrl = "http:127.0.0.1/8000/"

const addToCartForms = document.querySelectorAll('div.product-card div.image form');
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
            }
        })
    })
});

class Alert {

    constructor(content, type="success", bgColor="default") {

        this.content = content;
        this.type = type;
        this.bgColor = bgColor;
        this.htmlElement = document.createElement('div');
        this.render();
    }

    render(){
    
        this.htmlElement.className = 'alert alert-' + this.type;
        let span = document.createElement('span');
        span.className = 'content';
        span.innerText = this.content;

        this.htmlElement.appendChild(span);

        let button = document.createElement('button');
        button.className = "close";

        button.innerHTML = svgCross;

        button.addEventListener('click', (e) => {
            this.htmlElement.parentNode.removeChild(this.htmlElement);
        })

        this.htmlElement.appendChild(button);
    }

    insertBefore(element) {
        document.body.insertBefore(this.htmlElement, element);
        (async function(){
            await new Promise((resolve, reject) => {
                setTimeout(() => {
                    resolve('ok');
                }, 3000) ;
            });
        })().then((result) => {
            this.htmlElement.parentNode.removeChild(this.htmlElement);
        });
    }
}

class Prompt {

    constructor(title="?", content="", yesLabel="Confirmer", noLabel="Annuler") {
        this.title = title;
        this.content = content;
        this.yesLabel = yesLabel;
        this.noLabel = noLabel;

        this.render() ;
    }

    render() {
        // Container
        this.htmlElement = document.createElement('div');
        this.htmlElement.className = 'prompt-container';

        // title
        let h1 = document.createElement('h1') ;
        h1.innerText = this.title;
        this.htmlElement.appendChild(h1) ;
        
        // form 
        let form = document.createElement('form') ;
        form.setAttribute('action', '');

        // label
        let label = document.createElement('label') ;
        label.setAttribute('for', 'quantity');
        label.innerText = this.content ;
        form.appendChild(label) ;

        // input
        let input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.setAttribute('min', '0');
        input.setAttribute('name', 'quantity');
        input.setAttribute('id', 'quantity');
        form.appendChild(input) ;

        // action button container
        let div = document.createElement('div') ;
        div.className = "action" 

        let cancel = document.createElement('button') ;
        let accept = document.createElement('input') ;

        accept.setAttribute('type', 'submit') ;
        accept.setAttribute('value', this.yesLabel) ;

        cancel.innerText = this.noLabel ;

        div.appendChild(cancel) ;
        div.appendChild(accept) ;

        form.appendChild(div) ;

        this.htmlElement.appendChild(form) ;

        let close = document.createElement('button') ;
        close.className = "close-btn" ;
        close.innerHTML = svgCross ;

        this.htmlElement.appendChild(close) ;

        close.addEventListener('click', (e) => {

            this.htmlElement.parentNode.removeChild(this.htmlElement) ;
        })

        cancel.addEventListener('click', (e) => {

            this.htmlElement.parentNode.removeChild(this.htmlElement) ;
        })  

    }

}


var svgCross = `<svg width="800px" height="800px" viewBox="0 0 24 24" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<style type="text/css">
    .st0{opacity:0.2;fill:none;stroke:#000000;stroke-width:5.000000e-02;stroke-miterlimit:10;}
</style>
<g id="grid_system"/>
<g id="_icons">
<path d="M5.3,18.7C5.5,18.9,5.7,19,6,19s0.5-0.1,0.7-0.3l5.3-5.3l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3   c0.4-0.4,0.4-1,0-1.4L13.4,12l5.3-5.3c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0L12,10.6L6.7,5.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4   l5.3,5.3l-5.3,5.3C4.9,17.7,4.9,18.3,5.3,18.7z" fill="var(--dark-border)"/>
</g>
</svg>` ;