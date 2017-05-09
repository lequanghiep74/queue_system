$(document).ready(function () {
    $('.logout').click(function () {
        window.localStorage.removeItem('user');
        window.location.href = 'login.html';
    });
});