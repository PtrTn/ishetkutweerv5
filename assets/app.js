import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';


Gauge(
    document.getElementById("wind-gauge"), {
        max: 10,
        dialStartAngle: 0,
        dialEndAngle: 180,
        value: 6,
        viewBox: "0 0 100 60"
    }
);


const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'line',
    color: '#5c9ce5',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
        datasets: [
            {
                borderColor: '#5c9ce5',
                tension: 0.1,
                fill: {
                    target: 'origin',
                    above: '#5c9ce5',
                },
                data: [1, 2, 0, 0, 2],
                borderWidth: 5,
                pointRadius: 0,
            },
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                display: false
            },
            y: {
                display: false,
                suggestedMin: 0,
                suggestedMax: 5,
            },
        }
    }
});
