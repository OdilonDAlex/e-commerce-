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

export const messageContainer = document.querySelector('div.message-container');
const closeBtn = messageContainer.querySelector('button.close-btn');
const sendMessageForm = messageContainer.querySelector('form');
export const conversationBody = messageContainer.querySelector('div.conversation-body');

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
        conversationBody.appendChild(createMessage(content, ""));

        let data = {
            content: content,
            receiver_id: parseInt(sendMessageForm.querySelector('input[type="hidden"]').value),
        }
        input.value = "";
        conversationBody.scrollTo(0, conversationBody.clientHeight*9999);
        
        console.log(data);
        axios.post(`${window.origin}/chat/create/`, data)
        .then( (result) => {
            console.log(result);
        })
        .catch( (error) => {
            conversationBody.querySelector('p.status').innerText = "ouups, erreur d'envoi...";
            console.log(error);
        } )
    }
})

export function createMessage(content, status="", position="right") {
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

    if((parseInt(authId) !== -1) && (userRole != 'admin')){

        window.Echo.private(`chat-1-${authId}`)
            .listen('.message-sent', (result) => {
                let message = result.message;
                if(result.receiver_id == authId){
                    conversationBody.appendChild(createMessage(message.content, '', 'left'));
                    conversationBody.scrollTo(0, conversationBody.clientHeight*999);
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
                }
            });
        })
        .catch((error) => {;}) 
    }
})
.catch( (error) => {
    console.log(error);
});