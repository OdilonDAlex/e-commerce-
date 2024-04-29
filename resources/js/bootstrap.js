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
// const conversation_container = document.querySelector('.conversation_container')
// const send_message_form = document.forms.send_message_form;
// const textarea = send_message_form.elements.message_content;
// const receiver_id = send_message_form.elements.receiver_id;
// const send_message_button = send_message_form.elements.send_message_button;

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

// window.Echo.private('chat-1-2')
//     .listen('MessageSent', (event_) => {
//         console.dir(event_);
//     })

// send_message_button.addEventListener('click', (event_) => {
//     event_.preventDefault();

//     let data = {
//         message_content: textarea.value,
//         receiver_id: receiver_id.value,
//     }
//     textarea.value = '';
//     // let message = new Message(content=data.message_content, position='right');

//     axios.post('chat/create', data)
//         .then( (result) => console.log(result) )
//         .catch( (error) => { console.error(error); } )
// })


// class Message {

//     constructor(content, position, color='lightblue') {
//         this.content = content;
//         this.node = null;
//         this.position = position;
//         this.color = color;
//         this.make_html_element();
//         this.set_style_sheet();
//     }

//     make_html_element() {
//         let p = document.createElement('p');

//         p.innerText = this.content;
//         this.node = p;
//     }

//     set_style_sheet() {

//         this.node.style.color = this.color;
//         this.node.className = 'message' + ' ' + this.position;
//     }
// }

