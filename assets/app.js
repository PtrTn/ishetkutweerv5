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


new Chart(document.getElementById('rainChart'), {
    type: 'line',
    color: '#5c9ce5',
    data: {
        labels: ['10:00', '11:00', '12:00', '13:00', '14:00'],
        datasets: [
            {
                borderColor: '#5c9ce5',
                tension: 0.1,
                fill: {
                    target: 'origin',
                    above: '#5c9ce5',
                },
                data: [1, 2, 0, 0, 2],
                borderWidth: 0,
                pointRadius: 0,
            },
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 20,
                right: 20,
            }
        },
        scales: {
            x: {
                display: false,
            },
            y: {
                display: false,
                suggestedMin: 0,
                suggestedMax: 5,
            },
        },
        plugins: {
            legend: {
                display: false
            },
            annotation: {
                annotations: [
                    {
                        type: 'line',
                        mode: 'vertical',
                        scaleID: 'x',
                        value: '10:00',
                        borderColor: 'grey',
                        borderWidth: 2,
                    },
                    {
                        type: 'line',
                        mode: 'vertical',
                        scaleID: 'x',
                        value: '11:00',
                        borderColor: 'grey',
                        borderWidth: 1,
                    },
                    {
                        type: 'line',
                        mode: 'vertical',
                        scaleID: 'x',
                        value: '12:00',
                        borderColor: 'grey',
                        borderWidth: 1,
                    },
                    {
                        type: 'line',
                        mode: 'vertical',
                        scaleID: 'x',
                        value: '13:00',
                        borderColor: 'grey',
                        borderWidth: 1,
                    },
                    {
                        type: 'line',
                        mode: 'vertical',
                        scaleID: 'x',
                        value: '14:00',
                        borderColor: 'grey',
                        borderWidth: 2,
                    },
                ]
            }
        }
    }
});
