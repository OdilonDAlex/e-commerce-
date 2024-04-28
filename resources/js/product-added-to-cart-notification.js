import axios from "axios";
var baseUrl = "http:127.0.0.1/8000/"

const addToCartForms = document.querySelectorAll('div.product-card div.image form');
const cartItemsCount = document.querySelector('header ul.nav li.nav-item span.cart-items-count');
const notificationItemsCount = document.querySelector('header ul.nav li.nav-item span.notification-count');var section = document.querySelector('section.content');

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
        let result;
        let alert_ = new Alert('Votre demande est en cours de traitement...');
        alert_.insertBefore(section);

        try {
            result = parseInt(makePrompt()) ;
    
            console.log(result) ;
        }

        catch(exception) {
            result = 1;
        }

        let data = {
            product_id: productId,
            quantity: result
        }

        axios.post('../cart/add', data)
        .then( (result ) => {
            Notification.requestPermission()
            .then( (allow) => {
                
                
                let notification = new Notification('Ajout de produit', {
                    body: 'Le Produit a bien été ajouté dans votre panier.\nCliquer ici pour visualiser votre panier\nMerci.',
                });

                cartItemsCount.innerText = parseInt(cartItemsCount.innerText) + 1;
                notificationItemsCount.innerText = parseInt(notificationItemsCount.innerText) + 1;

                cartItemsCount.style.display = 'inline';
                notificationItemsCount.style.display = 'inline';

                if(alert_.htmlElement !== undefined && alert_.htmlElement !== null) {
                    alert_.htmlElement.querySelector('span').innerText = "Le produit a bien été ajouter dans votre panier." ;
                }

                notification.onclick = function (e) {
                    window.location.href = 'cart/' ;
                }
            })
        })
        .catch((error) => {
            console.error(error) ;
        })

    })
});


function makePrompt() {
    return window.prompt('Quantité ( par défaut 1): ', '1');
}


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