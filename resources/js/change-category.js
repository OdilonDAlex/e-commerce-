import axios from "axios";
import { Alert } from "./models";
import { productCard } from "./product-card-template";
import { addProduct } from "./add-to-cart";

try {
    const productsInByCategoryContainer = document.querySelector('div.by-categories');
    let products = productsInByCategoryContainer.querySelectorAll('div.product-card');

    window.productCard = productCard; 
    productCard.querySelector('div.edit-btn').style.display = 'none';

    const buttonChangeCategoryContainer = document.querySelector('div.categories');
    const buttons = buttonChangeCategoryContainer.querySelectorAll('button.category');

    buttons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            axios.get(`/api/products/category/${button.innerText}`)
                .then( (result) => {
                    productsInByCategoryContainer.style.display = 'grid';
                    productsInByCategoryContainer.innerHTML = '';

                    try {
                        for(let product of result.data.data){
                            productsInByCategoryContainer.appendChild(renderProduct(product)); 
                        }
                    }
                    catch(error){
                        let alert_ = new Alert('Aucun produit n\' a été trouvé', 'success');
                        alert_.htmlElement.style.position = 'relative';
                        alert_.htmlElement.style.minWidth = '100%' ;
                        alert_.htmlElement.style.display = 'block';
                        productsInByCategoryContainer.style.display = 'block';
                        productsInByCategoryContainer.appendChild(alert_.htmlElement);
                    }
                    

                    buttons.forEach(button_ => {
                        button_.className = "category";
                    })

                    button.className = "category active";

                    products = productsInByCategoryContainer.querySelectorAll('div.product-card');
                })
                .catch( (error) => { 
                    let alert_ = new Alert('Ouups, une erreur s\'est produite...', 'error');
                    alert_.insertBefore(document.querySelector('section.content'));
                    console.log(error);
                } );
        })
    });
}
catch(e){;}



function renderProduct(product){

    let cardTemplate = productCard.cloneNode(true);
    let imageContainer = cardTemplate.querySelector('div.image');
    let productDetails = cardTemplate.querySelector('div.product-details');

    console.log(product);
    
    
    let form = imageContainer.querySelector('form');
    if(document.querySelector('header li.nav-item.nav-dropdown') !== null){
        cardTemplate.querySelector('div.edit-btn').style.display = 'block';
        cardTemplate.querySelector('div.edit-btn a').href = `${window.origin}/admin/product/edit/${product.id}`;
    }

    if(document.querySelector('header form input.logout-btn') !== null && product.stock > 0){
        form.elements.product_id.value = product.id;

        form.addEventListener('submit', (event) => {
            event.preventDefault() ;
    
            addProduct(form, product.id);
        })
    }

    else {
        form.style.display = 'none';
    }


    imageContainer.querySelector('div.float-element h5.price').innerText = product.price + ' Ar';

    imageContainer.querySelector('img.img').setAttribute('src', product.image_url);
    productDetails.querySelector('h1.name').innerText = product.name;

    try {
        productDetails.querySelector('h1.price').innerText = product.price + ' Ar';
    }
    catch(error){} ;

    productDetails.querySelector('h1.stock').innerText = (parseInt(product.stock) > 0 ? product.stock + " disponible(s)" : "en rupture de stock");


    let actionContainer = cardTemplate.querySelector('div.action');

    actionContainer.querySelector('a.show').href = `${window.origin}/product/show/${product.slug}?product_id=${product.id}` ;

    return cardTemplate;
}
