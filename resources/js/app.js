import Alpine from 'alpinejs';
import flatpckr from 'flatpickr';
window.Alpine = Alpine;
window.flatpckr = flatpckr;

flatpickr('.subscribe', {
    mode: "multiple",
    minDate: new Date().fp_incr(7),
    dateFormat: "Y-m-d",
    "disable": [
        function (date) {
            return (date.getDay() === 0);
        }
    ],
    "locale": {
        "firstDayOfWeek": 1
    }
});

Alpine.start();
