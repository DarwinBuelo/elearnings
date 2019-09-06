$('.number-only').on('keyup keydown change',function(){
    $(this).value().isNumeric();
});