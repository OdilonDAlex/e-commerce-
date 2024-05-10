import axios from "axios";
import { messageContainer } from "../message";
import { createMessage } from "../message";
import { conversationBody } from "../message";

const usersList = document.querySelector('div.users');
const allUsersLi = usersList.querySelectorAll('div.user');
const sendMessageForm = document.forms.sendMessageForm;

allUsersLi.forEach(div => {
    div.addEventListener('click', (event) => {
        event.preventDefault();

        if(usersList.querySelector('.active') !== div){
            conversationBody.innerHTML = "";
            let userId = parseInt(div.className.replace(/[^0-9]*/, ''))
            sendMessageForm.elements.receiver_id.value = userId;
            messageContainer.querySelector('h1.recipient').innerText = div.querySelector('h3.name').textContent;

            try {
                let currentActiveDiv = usersList.querySelector('div.active') ;
                currentActiveDiv.className = currentActiveDiv.className.replace(/active/, '');
            }
            catch(e){;}

            div.className += ' active' ;
            axios.get(`${window.origin}/chat/messages/${userId}`)
            .then( (result) => {
                conversationBody.innerHTML = "";
                let messages = result.data;

                messages.forEach(message => {
                    let position = message.author_id == userId ? 'left' : 'right';
                    conversationBody.appendChild(createMessage(message.content, '', position));
                });

                conversationBody.scrollTo(0, conversationBody.clientHeight*999);
            })
            .catch( (error) => {;});
        }   

    })
});