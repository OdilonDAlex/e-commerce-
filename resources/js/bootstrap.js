import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

const send_message_form = document.forms.send_message_form;
const textarea = send_message_form.elements.message_content;
const receiver_id = send_message_form.elements.receiver_id;
const send_message_button = send_message_form.elements.send_message_button;


send_message_button.addEventListener('click', (event_) => {
    event_.preventDefault();

    let data = {
        message_content: textarea.value,
        receiver_id: receiver_id,
    }

    axios.post('/chat/create', data)
        .then(broadcastMessage)
        .catch( (error) => { console.error(error); })
})


function broadcastMessage() {
    console.log('broadcast')
}