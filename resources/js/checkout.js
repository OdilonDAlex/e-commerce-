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