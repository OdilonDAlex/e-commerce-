export var productCard = document.createElement('div');
productCard.className = 'product-card';

productCard.innerHTML=`
    <div class="edit-btn">
    <a href="http://127.0.0.1:8000/admin/product/edit/6">
        <svg width="800px" height="800px" viewBox="0 0 128 128" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

        <style type="text/css">
        .st0{display:none;}
        .st1{display:inline;}
        .st2{fill:none;stroke:#0F005B;stroke-width:8;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
        </style>

        <g class="st0" id="Layer_1"/>

        <g id="Layer_2">

        <circle class="st2" cx="64" cy="65" r="14.5"/>

        <path class="st2" d="M78.4,104.3L75,112c-10.5,0-11.6,0-22.1,0l-3.4-7.7c-4.6-2.6-7.8-4.5-12.3-7.1l-8.4,0.9   c-5.2-9.1-5.8-10-11-19.1l5-6.8c0-5.3,0-9,0-14.2l-5-6.8c5.2-9.1,5.8-10,11-19.1l8.4,0.9c4.6-2.6,7.8-4.5,12.3-7.1l3.4-7.7   c10.5,0,11.6,0,22.1,0l3.4,7.7c4.6,2.6,7.8,4.5,12.3,7.1l8.4-0.9c5.2,9.1,5.8,10,11,19.1l-5,6.8c0,5.3,0,9,0,14.2l5,6.8   c-5.2,9.1-5.8,10-11,19.1l-8.4-0.9"/>

        </g>
        </svg></a>
    </div>
    <div class="image">
        <div class="float-element">
            <h5 class="price"></h5> 
            
            <form name="addToCart" action="" method="POST">               
                <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="quantity" value="1" min="0" max="5">
                        
                <button name="send_form" type="submit">
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" fill="#1C274C"/>
                        <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" fill="#1C274C"/>
                        <path opacity="0.5" d="M2.08368 2.7512C2.22106 2.36044 2.64921 2.15503 3.03998 2.29242L3.34138 2.39838C3.95791 2.61511 4.48154 2.79919 4.89363 3.00139C5.33426 3.21759 5.71211 3.48393 5.99629 3.89979C6.27827 4.31243 6.39468 4.76515 6.44841 5.26153C6.47247 5.48373 6.48515 5.72967 6.49184 6H17.1301C18.815 6 20.3318 6 20.7757 6.57708C21.2197 7.15417 21.0461 8.02369 20.699 9.76275L20.1992 12.1875C19.8841 13.7164 19.7266 14.4808 19.1748 14.9304C18.6231 15.38 17.8426 15.38 16.2816 15.38H10.9787C8.18979 15.38 6.79534 15.38 5.92894 14.4662C5.06254 13.5523 4.9993 12.5816 4.9993 9.64L4.9993 7.03832C4.9993 6.29837 4.99828 5.80316 4.95712 5.42295C4.91779 5.0596 4.84809 4.87818 4.75783 4.74609C4.66977 4.61723 4.5361 4.4968 4.23288 4.34802C3.91003 4.18961 3.47128 4.03406 2.80367 3.79934L2.54246 3.7075C2.1517 3.57012 1.94629 3.14197 2.08368 2.7512Z" fill="#1C274C"/>
                        <path d="M13.75 9C13.75 8.58579 13.4142 8.25 13 8.25C12.5858 8.25 12.25 8.58579 12.25 9V10.25H11C10.5858 10.25 10.25 10.5858 10.25 11C10.25 11.4142 10.5858 11.75 11 11.75H12.25V13C12.25 13.4142 12.5858 13.75 13 13.75C13.4142 13.75 13.75 13.4142 13.75 13V11.75H15C15.4142 11.75 15.75 11.4142 15.75 11C15.75 10.5858 15.4142 10.25 15 10.25H13.75V9Z" fill="#1C274C"/>
                        </svg>
                </button>   
        </div>
        
        <!-- image -->
        <img class="img" src="" alt="">
    </div>
    <div class="product-details">        
    <!-- details du produit -->
    <h1 class="name">Demarco Kshlerin</h1>
            <h1 class="price">
                <span class="price old-price"></span>
                <!-- price -->
            <h1>
            <h1 class="stock"></h1>
    </div>

    <!-- action -->
    <div class="action">
    <a class="show" href="">plus de details</a>   
    </div>
`;