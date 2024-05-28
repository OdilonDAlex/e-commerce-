import axios from "axios";
import { messageContainer } from "../message";
import { createMessage } from "../message";
import { conversationBody } from "../message";
import '../echo';


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


window.Echo.private('reload-listener')
    .listen('.new-user-connected', (result) => {

        let channel = window.Echo.private(`chat-1-${result.user.id}`);

        channel.stopListening('.message-sent');

        channel.listen('.message-sent', ( result ) => {
                let message = result.message;

                if(sendMessageForm.elements.receiver_id.value == message.author_id){
                    conversationBody.appendChild(createMessage(message.content, '', 'left'));
                    conversationBody.scrollTo(0, conversationBody.clientHeight*999);
                }
                else {
                    let senderLiTemplate = document.querySelector(`div.user-${message.author_id}`);
                    
                    console.log(senderLiTemplate);
                    if(senderLiTemplate !== undefined && senderLiTemplate !== null){
                        senderLiTemplate.querySelector('p.last-message').innerText = message.content;
                        senderLiTemplate.querySelector('p.last-message').style.color = 'var(--primary-btn)';
                    }
                }
            });
    });