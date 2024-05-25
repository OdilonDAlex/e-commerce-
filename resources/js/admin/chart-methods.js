import { Chart } from "chart.js/auto";
import { DoughnutController } from "chart.js/auto";
import { PieController } from "chart.js/auto";

Chart.register(DoughnutController);
Chart.register(PieController);

export function displayChartBar(ctx, labels, data, supLabel){
    new Chart(ctx, {
        data: {
            labels: labels,
            datasets: [{
                type: 'bar',
                label: supLabel ,
                barThickness: 50,
                borderRadius: 5,
                data: data,
                borderWidth: .5,
                backgroundColor: ['#2c698d', '#272643', '#bae8e8', '#e3e3e3', '#272643', '#e3f6f5'],
            }, {
                label: '',
                type: 'line',
                data: data,
                backgroundColor: '#2c698d',
            },
        ]
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

export function displayPieBar(ctx, labels, data, supLabel){
    new Chart(ctx, {
        type: 'pie', 
        data: { 
            datasets:  [{
                label: supLabel,
                data: data, 
            }],
            labels: labels,
        },
    })
}
