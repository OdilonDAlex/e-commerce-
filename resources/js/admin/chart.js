import { Chart } from "chart.js/auto";

let ctx = document.querySelector('div.charts canvas');

console.log(ctx);

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Green', 'Yellow', 'Purple', 'Orange'],
        datasets: [{
            label: "Produits vendu",
            data: [5, 2, 7, 10, 10, 5, 9],
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