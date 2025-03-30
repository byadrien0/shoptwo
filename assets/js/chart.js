var ctx = document.getElementById('myChart').getContext('2d');
var tfChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','Jul'],
        datasets: [
            {
                label: 'Price',
                backgroundColor: '#161616',
                data: [53, 162, 93, 131, 36, 93, 40],
                order: 2,         
            },
            {
                label: 'Sale',
                data: [31, 114, 65, 93, 21, 73, 25],
                borderColor: '#DDF247', 
                borderWidth: 2, 
                fill: false, 
                type: 'line',
                order: 1,
                zIndex:2
            }
        ]
    },
    options: {
        scales: {
            x: {
            grid: {
                display: false,
            }
            },
            y: {                   
            beginAtZero: true,               
            ticks: {
                precision: 0,
                stepSize: 50,                    
            },               
            }
        },
        plugins: {
            legend: {
            display: false
            },
            tooltip: {
                yAlign: 'bottom',
                backgroundColor: 'rgba(222, 232, 232, 0.20)',
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.value;
                    }
                }
            },
        },
        elements:{
            bar:{
                borderRadius: 20
            }                
        }
    }
});