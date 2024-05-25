const scrollToTopButton = document.querySelector("button.scrollToTop") ;

scrollToTopButton.addEventListener('click', (event) => {
    scrollTo(0, 0) ;
})

import './bootstrap';
import '../css/header.css';
import './message';
import './responsive'

const alerts = document.querySelectorAll('div.alert') ;

alerts.forEach(alert => {
    alert.querySelector('button.close').addEventListener('click', (e) => {

        alert.parentNode.removeChild(alert) ;
    });

})