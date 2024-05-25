const collapseSessionBtn = document.querySelector('header button.session') ;
const collapseMenuBtn = document.querySelector('header button.menu') ; 
const sessionInfo = document.querySelector('header div.session-info') ;
const anchor = document.querySelector('header div.anchor');
const navbar = document.querySelector('.navbar-container ul');

collapseSessionBtn.addEventListener('click', (event) => {

    event.preventDefault();

    toggleDisplay(sessionInfo);
    toggleDisplay(anchor);
})

collapseMenuBtn.addEventListener('click', (event) => {
    event.preventDefault();

    toggleDisplay(navbar);
})



function toggleDisplay(element){
    if(element.style.visibility == "visible"){
        element.style.visibility = "hidden";
    }
    else{
        element.style.visibility = "visible";
    }
}