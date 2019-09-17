$('document').ready(function () {

    //auto compute the age of the user
    $('#birthday').on('change keyup', function () {
        var inputDate = $('#birthday').val();
        var age = null;
        
        age = _calculateAge(inputDate);
        $('#age').val(age);
    });


});


function _calculateAge(birthday) { 
    var today = new Date();
    var birthDate = new Date(birthday);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}