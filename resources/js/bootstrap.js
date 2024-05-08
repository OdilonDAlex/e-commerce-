import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
import './add-to-cart';

const user_id_input = document.querySelector("input[type='hidden']#authenticated_user_id"); 
const user_id = user_id_input == null ? null : user_id_input.value;
const cartItemsCount = document.querySelector('header ul.nav li.nav-item span.cart-items-count');
const notificationItemsCount = document.querySelector('header ul.nav li.nav-item span.notification-count');

if(user_id !== null) {

    window.Echo.private(`user-${user_id}-add-product-to-cart`)
        .notification( (data)  => {
            Notification.requestPermission()
            .then( (e) => {
                
                
                let notification = new Notification(data.title, {
                    body: data.content,
                });
                
                if(data.type == "product-added-to-cart") {
                    cartItemsCount.innerText = parseInt(cartItemsCount.innerText) + 1;
                }

                notificationItemsCount.innerText = parseInt(notificationItemsCount.innerText) + 1;

                cartItemsCount.style.display = 'inline';
                notificationItemsCount.style.display = 'inline';

                notification.onclick = function (e) {
                    window.location.href = 'history/' ;
                }
            })
            .catch( (error) => {
                console.error(error);
            })
        })
}


