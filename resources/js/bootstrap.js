import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

const conversation_container = document.querySelector('.conversation_container')
const send_message_form = document.forms.send_message_form;
const textarea = send_message_form.elements.message_content;
const receiver_id = send_message_form.elements.receiver_id;
const send_message_button = send_message_form.elements.send_message_button;


window.Echo.private('chat-1-2')
    .listen('MessageSent', (event_) => {
        console.dir(event_);
    })

send_message_button.addEventListener('click', (event_) => {
    event_.preventDefault();

    let data = {
        message_content: textarea.value,
        receiver_id: receiver_id.value,
    }
    textarea.value = '';
    // let message = new Message(content=data.message_content, position='right');

    axios.post('chat/create', data)
        .then( (result) => console.log(result) )
        .catch( (error) => { console.error(error); } )
})


class Message {

    constructor(content, position, color='lightblue') {
        this.content = content;
        this.node = null;
        this.position = position;
        this.color = color;
        this.make_html_element();
        this.set_style_sheet();
    }

    make_html_element() {
        let p = document.createElement('p');

        p.innerText = this.content;
        this.node = p;
    }

    set_style_sheet() {

        this.node.style.color = this.color;
        this.node.className = 'message' + ' ' + this.position;
    }
}