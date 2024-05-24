const scrollToTopButton = document.querySelector("button.scrollToTop") ;

console.log(scrollToTopButton) ;
scrollToTopButton.addEventListener('click', (event) => {
    scrollTo(0, 0) ;
})

import './bootstrap';
import '../css/header.css';
import './message';

const alerts = document.querySelectorAll('div.alert') ;

alerts.forEach(alert => {
    alert.querySelector('button.close').addEventListener('click', (e) => {

        alert.parentNode.removeChild(alert) ;
    });

})



