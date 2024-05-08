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

        conversationBody.appendChild(createMessage(input.value));
        input.value = "";

        conversationBody.scrollTo(0, conversationBody.clientHeight);
    }
})

function createMessage(content) {
    let container = document.createElement('div');
    container.className = "message right"

    let divContent = document.createElement('div');
    divContent.className = 'content';

    divContent.innerText = content;

    container.appendChild(divContent);

    return container;
}