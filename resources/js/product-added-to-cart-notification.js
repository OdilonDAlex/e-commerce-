import axios from "axios";

const addToCartForms = document.querySelectorAll('div.product-card div.image form');
const cartItemsCount = document.querySelector('header ul.nav li.nav-item span.cart-items-count');

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
