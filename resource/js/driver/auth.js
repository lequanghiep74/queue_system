$(document).ready(function () {
    if (window.localStorage.getItem('user') === null || window.localStorage.getItem('user') === undefined) {
        window.location.href = 'login.html';
    }

    var user = JSON.parse(window.localStorage.getItem('user'));
    if (user.type !== 'driver') {
        window.location.href = 'login.html';
    }
});