import axios from "axios";

const messageCollapse = document.querySelector('section.content div.message-collapse');
const toggleMessageContainer = messageCollapse.querySelector('button.collapse-btn') ;
const messageContainer = messageCollapse.querySelector('div.message-container');
const closeBtn = messageContainer.querySelector('button.close-btn');
const sendMessageForm = messageContainer.querySelector('form');
const conversationBody = messageContainer.querySelector('div.conversation-body');

closeBtn.addEventListener('click', (event) => {

    event.preventDefault() ;

    messageContainer.style.display = 'none';
})
toggleMessageContainer.addEventListener('click', (event) => {

    event.preventDefault() ;
    
    messageContainer.style.display = 'flex' ;
});

sendMessageForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let input = sendMessageForm.querySelector('input[type="text"]');
    
    if(input.value !== ''){
        let content = input.value;
        conversationBody.appendChild(createMessage(content, "en cours d'envoi..."));
        
        console.log(parseInt(sendMessageForm.querySelector('input[type="hidden"]').value));
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

function createMessage(content, status="") {
    let container = document.createElement('div');
    container.className = "message right"

    let divContent = document.createElement('div');
    divContent.className = 'content';

    divContent.innerText = content;

    container.appendChild(divContent);

    if(status !== ""){
        let statusContainer = messageCollapse.querySelector('p.status');
        
        if(statusContainer === undefined || statusContainer === null){
            statusContainer = document.createElement('p');
            statusContainer.className = "status";
        }
    
        statusContainer.innerText = status;
        divContent.appendChild(statusContainer);
    }

    return container;
}



// listener
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
//     let message = new Message(content=data.message_content, position='right');

//     axios.post('chat/create', data)
//         .then( (result) => console.log(result) )
//         .catch( (error) => { console.error(error); } )
// })
