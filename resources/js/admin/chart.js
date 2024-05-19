import { Chart } from "chart.js/auto";
import axios from "axios";


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
    
    displayChartBar(ctxIncome, labels, data);
})
.catch((error) => {
    console.error(error);
})

function displayChartBar(ctx, labels, data){
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: `Revenu total (en Ariary) de ces ${labels.length} dernier(s) jour(s)` ,
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}