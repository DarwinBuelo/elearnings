jQuery(document).ready(function() {
    var emailDetails;
    var choices = [];
    var index = 0;
    var item = 1;
    jQuery("#finish").hide();
    jQuery.ajax({
        cache: false,
        type: "post",
        url: "common/ajax/exam.php",
        data: {
            examID: jQuery("#hash").val()
        },
        dataType: 'json',
        success: function (data) {
            examDetails = data;
            choices = examDetails[index].choices.split("//");
            jQuery("#question").html(item+") "+examDetails[index].question);
            jQuery.each(choices, function(key, value){
                jQuery("#choice" + key).html(value);
            });
            console.log(examDetails);
        },
        error: function (data) {
        }
    });
    jQuery("#next").click(function(event){
        event.preventDefault();
        alert(jQuery('input[name="radioChoice"]:checked').val());
        if (index == Object.keys(examDetails).length) {
            jQuery("#finish").show();
        } else {
            index++;
            item++;
        }
        jQuery("#question").html(item+") "+examDetails[index].question);
        choices = examDetails[index].choices.split("//");
        jQuery.each(choices, function(key, value){
            jQuery("#choice" + key).html(value);
        });
        jQuery("input:radio").attr("checked", false);
    });
    jQuery("#back").click(function(event){
        event.preventDefault();
        if (index != 0) {
            index--;
            item--;
        }
        jQuery("#question").html(item+") "+examDetails[index].question);
        choices = examDetails[index].choices.split("//");
        jQuery.each(choices, function(key, value){
            jQuery("#choice" + key).html(value);
        });
        jQuery("input:radio").attr("checked", false);
    });
});