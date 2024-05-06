import './bootstrap';
import '../css/header.css';
import './change-category.js';

const alerts = document.querySelectorAll('div.alert') ;

alerts.forEach(alert => {
    alert.querySelector('button.close').addEventListener('click', (e) => {

        alert.parentNode.removeChild(alert) ;
    });

})

