import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';


Gauge(
    document.getElementById("wind-gauge"), {
        max: 10,
        dialStartAngle: 180,
        dialEndAngle: 0,
        value: 6,
        viewBox: "0 0 100 60"
    }
);

new Chart(document.getElementById('rainChart2'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [20, 20, 20, 20, 20],
            needleValue: 40,
            backgroundColor: ["#5c9ce5", "#5c9ce5", "#5c9ce5", "#5c9ce5", "#5c9ce5", "#5c9ce5"]
        }]
    },
    options: {
        cutout: 60,
        rotation: 270,
        circumference: 180,
        elements: {
            arc: {
                borderWidth: 15,
            }
        }
    },

    plugins: [{
        afterDraw: chart => {
            return;
            var needleValue = chart.config.data.datasets[0].needleValue;
            var dataTotal = chart.config.data.datasets[0].data.reduce((a, b) => a + b, 0);
            var angle = Math.PI + (1 / dataTotal * needleValue * Math.PI);
            var ctx = chart.ctx;
            var cw = chart.canvas.offsetWidth;
            var ch = chart.canvas.offsetHeight;
            var cx = cw / 2;
            var cy = ch - 6;

            console.log(chart.config.data.datasets, dataTotal, angle)

            ctx.translate(cx, cy);
            ctx.rotate(angle);
            ctx.beginPath();
            ctx.moveTo(0, -3);
            ctx.lineTo(ch - 20, 0);
            ctx.lineTo(0, 3);
            ctx.fillStyle = 'rgb(0, 0, 0)';
            ctx.fill();
            ctx.rotate(-angle);
            ctx.translate(-cx, -cy);
            ctx.beginPath();
            ctx.arc(cx, cy, 5, 0, Math.PI * 2);
            ctx.fill();
        }
    }],
});



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
