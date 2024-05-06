import axios from "axios";

const productsInByCategoryContainer = document.querySelector('div.by-categories');
let products = productsInByCategoryContainer.querySelectorAll('div.product-card');
const containerHeight = productsInByCategoryContainer.clientHeight;

var productCard = products[0];
var editLinkBaseUrl = (productCard.querySelector('div.edit-btn a').href).replace(/edit\/[0-9]+/, "edit/");
var showProductBaseUrl = (productCard.querySelector('div.action a.show').href).replace(/show\/.+/, 'show');

const buttonChangeCategoryContainer = document.querySelector('div.categories');
const buttons = buttonChangeCategoryContainer.querySelectorAll('button.category');

console.log(buttons);
buttons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        axios.get(`/api/products/category/${button.innerText}`)
            .then( (result) => {
                products.forEach(productCard => {
                    productCard.parentNode.removeChild(productCard);
                });

                for(let product of result.data.data){
                    productsInByCategoryContainer.appendChild(renderProduct(product)); 
                }

                buttons.forEach(button_ => {
                    button_.className = "category";
                })

                button.className = "category active";

                products = productsInByCategoryContainer.querySelectorAll('div.product-card');
            })
            .catch( (error) => { console.error('Une erreur s\'est produite...'); console.log(error);} );
    })
});


function renderProduct(product){

    let cardTemplate = productCard.cloneNode(true);
    let imageContainer = cardTemplate.querySelector('div.image');
    let productDetails = cardTemplate.querySelector('div.product-details');

    cardTemplate.querySelector('div.edit-btn a').href = editLinkBaseUrl + product.id;

    imageContainer.querySelector('div.float-element h5.price').innerText = product.price ;

    console.log(imageContainer);
    console.log(imageContainer.querySelector('form'));
    try {
        let form = imageContainer.querySelector('form');
        form.elements.product_id.value = product.id;
    }
    catch(error){;}
    
    imageContainer.querySelector('img.img').setAttribute('src', product.image_url);

    productDetails.querySelector('h1.name').innerText = product.name;

    try {
        productDetails.querySelector('h1.price').innerText = product.price + ' Ar';
    }
    catch(error){} ;

    productDetails.querySelector('h1.stock').innerText = (parseInt(product.stock) > 0 ? product.stock + " disponible(s)" : "en rupture de stock");

    let actionContainer = cardTemplate.querySelector('div.action');

    actionContainer.querySelector('a.show').href = `${showProductBaseUrl}/${product.slug}?product_id=${product.id}` ;

    return cardTemplate;
}
