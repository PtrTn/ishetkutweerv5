import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import Autocomplete from 'bootstrap5-autocomplete';

Autocomplete.init();
const opts = {
    onSelectItem: (item) => {
        document.getElementById("autocompleteLoader").classList.remove('visually-hidden');
        return window.location.href = '/' + item.value;
    },
    fullWidth: true,
    notFoundMessage: 'Geen plaats gevonden',
    startsWith: true,
    preventBrowserAutocomplete: true,
};
new Autocomplete(document.getElementById("autocompleteDatalist"), opts);

const windChart = document.getElementById('windChart');
const windValue = JSON.parse(windChart.getAttribute('data-windSpeed'));

const rainChart = document.getElementById('rainChart');
const rainData = JSON.parse(rainChart.getAttribute('data-rainData'));

const gaugeNeedle = {
    id: "gaugeNeedle",
    afterDatasetDraw(chart) {
        const {
            ctx,
            config,
            data
        } = chart;

        ctx.save();
        const needleValue = data.datasets[0].needleValue;
        const meterValue = data.datasets[0].meterValue;
        const dataTotal = data.datasets[0].data.reduce((a, b) => a + b, 0);
        const angle = Math.PI + (1 / dataTotal) * needleValue * Math.PI;

        const cx = chart._metasets[0].data[0].x;
        const cy = chart._metasets[0].data[0].y;

        // Needle
        ctx.translate(cx, cy);
        ctx.rotate(angle);
        ctx.beginPath();
        ctx.fillStyle = "#5c9ce5";
        ctx.moveTo(0, -10);
        ctx.lineTo(40, 0);
        ctx.lineTo(0, 10);
        ctx.fill();

        // Dot
        ctx.translate(-cx, -cy);
        ctx.beginPath();
        ctx.arc(cx, cy, 12, 0, 2 * Math.PI);
        ctx.fill();
        ctx.restore();

        // Value
        ctx.font = "bold 26px sans-serif";
        ctx.fillStyle = "black";
        ctx.textAlign = "center";
        ctx.fillText(meterValue, cx, cy - 55);
    }
};

var numberOfColoredBackgrounds = Math.round(windValue / 2);
var coloredBackgrounds = Array(numberOfColoredBackgrounds).fill("#5c9ce5");
var uncoloredBackgrounds = Array(5 - numberOfColoredBackgrounds).fill("#e9ecef");
new Chart(windChart, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [2, 2, 2, 2, 2],
            needleValue: windValue,
            meterValue: windValue + ' bft.',
            backgroundColor: coloredBackgrounds.concat(uncoloredBackgrounds),
        }]
    },
    options: {
        rotation: 270,
        cutout: '70%',
        circumference: 180,
        borderWidth: 10,
        events: [],
    },

    plugins: [gaugeNeedle]
});

new Chart(rainChart, {
    type: 'line',
    color: '#5c9ce5',
    data: {
        datasets: [
            {
                borderColor: '#5c9ce5',
                tension: 0.1,
                fill: {
                    target: 'origin',
                    above: '#5c9ce5',
                },
                data: rainData,
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
                annotations: Object.keys(rainData).map((time, index) => {
                    let borderWidth = 1;
                    if (index === 0 || index === (Object.keys(rainData).length - 1)) {
                        borderWidth = 2;
                    }
                    return ({
                        type: 'line',
                        mode: 'vertical',
                        scaleID: 'x',
                        value: time,
                        borderColor: 'grey',
                        borderWidth: borderWidth,
                    });
                })
            }
        }
    }
});
