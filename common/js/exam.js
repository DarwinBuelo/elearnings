jQuery(window).load(function() {
    var emailDetails;
    var choices = [];
    var index = 0;
    var item = 1;
    var answer = [];
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
            jQuery.each(choices, function(key, value) {
                jQuery("#choice" + key).html(value);
            });
            console.log(examDetails);
        },
        error: function (data) {
        }
    });
    jQuery("#next").click(function(event){
        event.preventDefault();
        var radioIndex = parseInt(jQuery('input[name="radioChoice"]:checked').val());
        answer.push([examDetails[index].exams_questions_id, item, jQuery("#choice" + radioIndex).html()]);
        console.log(answer[index]);
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