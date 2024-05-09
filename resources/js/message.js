import axios from "axios";
import './echo';

window.Echo = Echo;
let messageCollapse;
let toggleMessageContainer;

try {
    messageCollapse = document.querySelector('section.content div.message-collapse');
    toggleMessageContainer = messageCollapse.querySelector('button.collapse-btn');
}
catch(e){;}

const messageContainer = document.querySelector('div.message-container');
const closeBtn = messageContainer.querySelector('button.close-btn');
const sendMessageForm = messageContainer.querySelector('form');
const conversationBody = messageContainer.querySelector('div.conversation-body');

closeBtn.addEventListener('click', (event) => {

    event.preventDefault() ;

    messageContainer.style.display = 'none';
})

try {
    toggleMessageContainer.addEventListener('click', (event) => {
    
        event.preventDefault() ;
        
        messageContainer.style.display = 'flex' ;
    });
}
catch(e){;}

sendMessageForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let input = sendMessageForm.querySelector('input[type="text"]');
    
    if(input.value !== ''){
        let content = input.value;
        conversationBody.appendChild(createMessage(content, "en cours d'envoi..."));

        let data = {
            content: content,
            receiver_id: parseInt(sendMessageForm.querySelector('input[type="hidden"]').value),
        }
        input.value = "";
        conversationBody.scrollTo(0, conversationBody.clientHeight);
        
        console.log(data);
        axios.post(`${window.origin}/chat/create/`, data)
        .then( (result) => {
            console.log(result);
            conversationBody.querySelector('p.status').innerText = "envoyé";
        })
        .catch( (error) => {
            conversationBody.querySelector('p.status').innerText = "ouups, erreur d'envoi...";
            console.log(error);
        } )
    }
})

function createMessage(content, status="", position="right") {
    let container = document.createElement('div');
    container.className = "message " +  position;

    let divContent = document.createElement('div');
    divContent.className = 'content';

    divContent.innerText = content;

    container.appendChild(divContent);

    if(status !== ""){
        let statusContainer = messageContainer.querySelector('p.status');
        
        if(statusContainer === undefined || statusContainer === null){
            statusContainer = document.createElement('p');
            statusContainer.className = "status";
        }
    
        statusContainer.innerText = status;
        divContent.appendChild(statusContainer);
    }

    return container;
}


axios.get(`${window.origin}/auth/`)
.then( (result) => {
    let authId = result.data.id;
    let userRole = result.data.role;

    if(parseInt(authId) !== -1 && userRole != 'admin'){

        window.Echo.private(`chat-1-${authId}`)
            .listen('.message-sent', (result) => {
                let message = result.message;
                if(result.receiver_id == authId){
                    conversationBody.appendChild(createMessage(message.content, '', 'left'));
                }
            });
        
    }

    if(userRole == 'admin'){

        axios.get('/users/authenticated/ids')
        .then( (result) => {
            let ids = result.data;

            ids.forEach(id => {
                    // admin id
                if(id != 1){

                    window.Echo.private(`chat-1-${id}`)
                        .listen('.message-sent', ( result ) => {
                            let message = result.message;
                            if(result.receiver_id == authId){
                                conversationBody.appendChild(createMessage(message.content, 'message.created_at', 'left'));
                            }
                        });
                }
            });
        })
        .catch((error) => {;}) 
    }
})
.catch( (error) => {
    console.log(error);
});