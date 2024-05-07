const mesageCollapse = document.querySelector('section.content div.message-collapse');
const toggleMessageContainer = mesageCollapse.querySelector('button.collapse-btn') ;
const messageContainer = mesageCollapse.querySelector('div.message-container');
const closeBtn = messageContainer.querySelector('button.close-btn');

closeBtn.addEventListener('click', (event) => {

    event.preventDefault() ;

    messageContainer.style.display = 'none';
})
toggleMessageContainer.addEventListener('click', (event) => {

    event.preventDefault() ;
    
    messageContainer.style.display = 'block' ;
});