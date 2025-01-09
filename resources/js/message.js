import axios from "axios";
import './echo';
import gsap from "gsap";

window.Echo = Echo;
let messageCollapse;
let toggleMessageContainer;

try {
    messageCollapse = document.querySelector('section.content div.message-collapse');
    toggleMessageContainer = messageCollapse.querySelector('button.collapse-btn');
}
catch(e){;}

export const messageContainer = document.querySelector('div.message-container');

let closeBtn;
let sendMessageForm;
if(messageContainer){
    closeBtn = messageContainer.querySelector('button.close-btn');
    sendMessageForm = messageContainer.querySelector('form');
}


export const conversationBody = document.querySelector('div.conversation-body');

try {
    closeBtn.addEventListener('click', (event) => {

        event.preventDefault() ;

        gsap.to(messageContainer, {y: 200, scaleY: 0, opacity: 0.2, display: 'none', duration: .5});
    })
    
    toggleMessageContainer.addEventListener('click', (event) => {
        
        event.preventDefault() ;
        
        gsap.fromTo(messageContainer, {display: 'flex', y: 100, scaleY: .7, opacity: .9, duration: .8}, {display: 'flex', opacity: 1, scaleY: 1, y:0, ease: 'elastic'});
        gsap.fromTo(messageCollapse.querySelectorAll('div.message div.content'), {delay: .7, opacity: .8,  stagger: {each: 0.5 }, ease: 'elastic', duration: 1}, {opacity: 1});
    });
}
catch(e){;}

if(sendMessageForm){

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
            console.log(result)
        })
        .catch( (error) => {
            conversationBody.querySelector('p.status').innerText = "ouups, erreur d'envoi...";
            console.log(error);
        } )
    }
})

}
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
                console.log(message)
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
                    
                    let channel = window.Echo.private(`chat-1-${id}`);

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
                }
            });
        })
        .catch((error) => {;}) 
    }
})
.catch( (error) => {
    console.log(error);
});