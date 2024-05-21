import axios from "axios";
import { Alert } from "./models";

const paymentMethodForm = document.querySelector('div.payment-method form');
const labels = paymentMethodForm.querySelectorAll('div.methods label');

labels.forEach(label => {

    label.addEventListener('click', (event) => {

        let inputTel;
        try {
            let active = paymentMethodForm.querySelector('label.active');
            active.className = "";

            inputTel = document.querySelector(`input[type="tel"].active-input`);
            inputTel.className = inputTel.className.replace(' active-input', '');
            inputTel.style.display = "none";
        }   
        catch(error){;}
        
        inputTel = document.querySelector(`input[type="tel"].${label.getAttribute('for')}`);
        inputTel.className += " active-input";
        label.className = "active";
        inputTel.style.display = "block";
    });
})

paymentMethodForm.addEventListener('submit', (event) => {

    event.preventDefault();

    let data = {};

    let ticketInformationFormElements = document.forms.ticketInformation.elements; 
    console.log(ticketInformationFormElements)
    for(let i = 0; i < ticketInformationFormElements.length; i++){  
        let key = ticketInformationFormElements[i].getAttribute('id') || '_token' 
        data[key] = ticketInformationFormElements[i].value;
    }

    let activeLabel = paymentMethodForm.querySelector('label.active')
    data['payment'] = activeLabel.innerText;
    data['number'] = activeLabel.parentElement.querySelector('input[type="tel"]').value;

    axios.post(`${window.origin}/cart/buy`, data)
        .then( (result) => {
            console.log(result);
            let alert_ = new Alert(`Achat effectué avec succès\nMerci d'avoir acheté chez nous.`, 'success');
            alert_.insertBefore(document.querySelector('section.content'));

            setTimeout(() => {
                window.location.href = `${window.origin}/`;
            }, 5000);

        })
        .catch( (error) => {
            let alert_ = new Alert('Ouups, une erreur s\'est produite', 'error');
        } )
})