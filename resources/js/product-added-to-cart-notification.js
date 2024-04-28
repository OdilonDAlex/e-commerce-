import axios from "axios";

const addToCartForms = document.querySelectorAll('div.product-card div.image form');
const cartItemsCount = document.querySelector('header ul.nav li.nav-item span.cart-items-count');
const notificationItemsCount = document.querySelector('header ul.nav li.nav-item span.notification-count');

if(cartItemsCount !== null) {
    if(cartItemsCount.innerHTML == '0') {
        cartItemsCount.style.display = 'none' ;
        cartItemsCount = 0;
    }
    
    if(notificationItemsCount.innerText == '0') {
        notificationItemsCount.style.display = 'none' ;
        notificationItemsCount = 0;
    }
}

addToCartForms.forEach(form => {
    
    let productId = form.elements.product_id.value;

    form.addEventListener('submit', (event) => {
        event.preventDefault() ;
        let result;
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

        axios.post('cart/add', data)
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
                console.log(notificationItemsCount) ;
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
        this.htmlElement = document.createElement('div');
    }

    render(){

        this.htmlElement.className = 'alert alert-' + type;
        this.htmlElement.tex
    }

    
}