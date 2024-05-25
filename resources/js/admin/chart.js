import { Chart } from "chart.js/auto";
import axios from "axios";
import { displayChartBar, displayPieBar } from "./chart-methods";

let ctxTopSelled = document.querySelector('div.charts div.top-selled-products canvas'); 

let ctxIncome = document.querySelector('div.income canvas');
let dayNumber = 7;

axios.get(`${window.origin}/income/${dayNumber}`)
.then( (result) => {
    let df = result.data.data;

    let labels = []
    let data = []

    df.forEach(income => {
        labels.unshift(income.dayOfWeek + ". " + income.date);
        data.unshift(income.total);
    });
    
    displayChartBar(
            ctxIncome,
            labels,
            data,   
            `Revenu total (en Ariary) de ces ${labels.length} dernier(s) jour(s)`
        );
})
.catch((error) => {
    console.error(error);
})


let product = 5;
axios.get(`${window.origin}/top-selled-products/${product}`)
    .then( (result) => {
        let df = result.data.data;

        let labels = []
        let data = []

        df.forEach(product => {
            labels.unshift(product.name);
            data.unshift(product.selled)
        });
        
        displayPieBar(
                ctxTopSelled,
                labels,
                data,   
                `Top ${labels.length} des produits les plus vendus `
            );
    })
    .catch( (error ) => {
        console.error(error);
    })