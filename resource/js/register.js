/**
 * Created by thuan on 3/19/2017.
 */
$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        format:'dd/mm/yyyy',
        min:[1950,0,1],
        max:[2018,1,1]
    });
});