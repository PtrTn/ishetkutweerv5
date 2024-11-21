import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';


Gauge(
    document.getElementById("gauge5"), {
        max: 10,
        dialStartAngle: 0,
        dialEndAngle: 180,
        value: 6,
        viewBox: "0 0 100 60"
    }
);