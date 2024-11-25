import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';

const gaugeNeedle = {
    id: "gaugeNeedle",
    afterDatasetDraw(chart, args, options) {
        const {
            ctx,
            config,
            data,
            chartArea: { top, bottom, left, right, width, height }
        } = chart;

        ctx.save();
        const needleValue = data.datasets[0].needleValue;
        const meterValue = data.datasets[0].meterValue;
        const dataTotal = data.datasets[0].data.reduce((a, b) => a + b, 0);
        const angle = Math.PI + (1 / dataTotal) * needleValue * Math.PI;

        const cx = chart._metasets[0].data[0].x;
        const cy = chart._metasets[0].data[0].y;
        const outerRadius = chart._metasets[0].data[0].outerRadius;
        const innerRaidus = chart._metasets[0].data[0].innerRadius;

        // Needle
        ctx.translate(cx, cy);
        ctx.rotate(angle);
        ctx.beginPath();
        ctx.fillStyle = "#5c9ce5";
        ctx.fillRect(30, -10, innerRaidus - 50, 20);

        // Needle Dot
        ctx.translate(-cx, -cy);
        ctx.beginPath();
        ctx.arc(cx+10, cy, 10, 0, 2 * Math.PI);
        ctx.fill();
        ctx.restore();
    }
};

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
        rotation: 270,
        cutout: 90,
        aspectRatio: 1,
        circumference: 180,
        borderWidth: 10,
    },

    plugins: [gaugeNeedle]
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
