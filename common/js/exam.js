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
            displayQuestion();
        },
        error: function (data) {
        }
    });
    jQuery("#next").click(function(event){
        event.preventDefault();
        var radioIndex = parseInt(jQuery('input[name="radioChoice"]:checked').val());
        if (isNaN(radioIndex)) {
        } else {
            answer.push([examDetails[index].exams_questions_id, item, jQuery("#choice" + radioIndex).html(), examDetails[index].answer]);
            if (index == Object.keys(examDetails).length - 1) {
                jQuery("#next").hide();
                jQuery("#question").hide();
                jQuery("#questionTitle").hide();
                jQuery("#multipleChoice").hide();
                jQuery("#booleanChoice").hide();
                jQuery("#finish").show();
            } else {
                index++;
                item++;
                displayQuestion();
            }
            jQuery("input:radio").attr("checked", false);
        }
    });
    // jQuery("#back").click(function(event){
    //     event.preventDefault();
    //     if (index != 0) {
    //         index--;
    //         item--;
    //     }
    //     jQuery("#question").html(item+") "+examDetails[index].question);
    //     choices = examDetails[index].choices.split("//");
    //     jQuery.each(choices, function(key, value){
    //         jQuery("#choice" + key).html(value);
    //     });
    //     jQuery("input:radio").attr("checked", false);
    // });
    jQuery("#finish").click(function(event) {
        event.preventDefault();
        jQuery.ajax({
            cache: false,
            type: "post",
            url: "common/ajax/submitAnswer.php",
            data: {
                answer : answer
            },
            dataType: "json",
            success: function (result) {
                if (result.score == null) {
                    result.score = 0;
                }
                alert("Your Score is: "+result.score+"\nRemarks: "+result.remarks);
                location.href = "student.php?page=course";
            },
            error: function (data) {
            }
        });
    });

    function displayQuestion()
    {
        jQuery("#question").html(item+") "+examDetails[index].question);
        if (examDetails[index].exam_type == 3) {
            choices = examDetails[index].choices.split("//");
            jQuery.each(choices, function(key, value) {
                jQuery("#choice" + key).html(value);
            });
            multipleChoices();
        } else if (examDetails[index].exam_type == 2) {
            choices = ["true", "false"];
            jQuery.each(choices, function (key, value) {
                jQuery("#choice" + key).html(value);
            });
            booleanChoices();
        } else {
            essayChoices();
        }
    }

    function booleanChoices()
    {
        jQuery("#booleanChoice").show();
        jQuery("#multipleChoice").hide();
        jQuery("#essayChoice").hide();
    }
    function multipleChoices()
    {
        jQuery("#multipleChoice").show();
        jQuery("#booleanChoice").show();
        jQuery("#essayChoice").hide();
    }
    function essayChoices()
    {
        jQuery("#multipleChoice").hide();
        jQuery("#booleanChoice").hide();
    }
});