function displayFunction()
{
    jQuery.ajax({
        cache: false,
        type: "post",
        url: "common/ajax/displayExamDetails.php",
        data: {
            examID: jQuery("#examID").val(),
            examQuestionID: jQuery("#chooseQuestion").val()
        },
        dataType: 'json',
        success: function (data) {
            var emailDetails = data[0];
            var choices = emailDetails.choices.split("//");
            jQuery.each(choices, function (key, value) {
                jQuery("#choice" + key).val(value);
            });
            jQuery("#editAnswer").val(emailDetails.answer);
            jQuery("#editPoints").val(emailDetails.points);
        },
        error: function (data) {
        }
    });
}
jQuery(window).load(function () {
    jQuery("#editQuestionContainer").hide();
    //Edit Exam Question
    jQuery('.btnEdit').on('click', function(event){
        event.preventDefault();
        if (jQuery("#editAnswer").prop("disabled") == true) {
            jQuery("#editQuestion").innerHTML("testing");
            jQuery("#editQuestionContainer").show();
            jQuery("#editAnswer").prop("disabled", false);
            jQuery("#editPoints").prop("disabled", false);
            for (var x = 0; x <= 3; x++) {
                jQuery("#choice" + x).prop("disabled", false);
            }
        } else {
            jQuery("#editQuestion").val("sdasd");
            jQuery("#editQuestionContainer").hide();
            jQuery("#editAnswer").prop("disabled", true);
            jQuery("#editPoints").prop("disabled", true);
            for (var x = 0; x <= 3; x++) {
                jQuery("#choice" + x).prop("disabled", true);
            }
        }
    });
    //Edit Exam Action
    jQuery('.btnSave').on('click', function(e){
        e.preventDefault();
        jQuery("#editQuestionContainer").hide();
        var choices = [];
        var answer = jQuery("#answer").val();
        for (var x = 0; x <= 2; x++) {
            choices.push(jQuery("#examOptions" + x).val());
        }
        choices.push(answer);
        jQuery.ajax({
            cache: false,
            type: "post",
            url: "common/ajax/saveExamDetails.php",
            data: {
                examID: jQuery("#examID").val(),
                examType: jQuery("#examType").val(),
                points: jQuery("#points").val(),
                lessonID: jQuery("#lessonID").val(),
                question: jQuery("#question").val(),
                answer: answer,
                examType: jQuery("#examType").val(),
                booleanAnswer: jQuery("#selectAnswer").val(),
                choices: choices,
                courseID: jQuery("#courseID").val()
            },
            dataType: "json",
            success: function (questionDetails) {
                if (questionDetails.status == false) {
                    alert("Maximum items is only "+questionDetails.items);
                } else {
                    jQuery("#chooseQuestion").append("<option value='" + questionDetails.examQuestionID + "'>" + questionDetails.question + "</option>");
                    clearText();
                }
            },
            error: function (data) {
            }
        });
    });
    //Add Exam Action
    jQuery('#formAddExam').submit(function () {
        jQuery.ajax({
            cache: false,
            type: "post",
            url: "common/ajax/saveExamDetails.php",
            data: {
                lessonID: jQuery("#lessonIDEdit").val(),
                save: 1,
                teacherID: jQuery("#teacherID").val(),
                duration: jQuery("#duration").val(),
                items: jQuery("#items").val(),
                title: jQuery("#title").val(), 
                attempts: jQuery("#attempts").val(),
                passingScore: jQuery("#passingScore").val(),
                examDate: jQuery("#examDate").val(),
                examDue: jQuery("#examDue").val(),
                courseID: jQuery("#courseID").val()
            },
            success: function (data) {
            },
            error: function (data) {
            }
        });
    });
});
function exampTypeFunction()
{
    filterChooseQuestion();
    jQuery("#editAnswer").prop("disabled", true);
    jQuery("#editPoints").prop("disabled", true);
    for (var x = 0; x <= 3; x++) {
        jQuery("#choice" + x).prop("disabled", true);
    }
    switch (jQuery("#examType").val()) {
        case "1":
            essayContainer();
            break;
        case "2":
            booleanContainer();
            break;
        case "3":
            multipleChoiceContainer();
            break;
        default:
            hideContainer();
            break;
    }
}
function booleanContainer()
{
    jQuery("#answerContainerSelect").show();
    jQuery("#answerContainerText").hide();
    for (var x = 0; x <= 3; x++) {
        if (x <= 2) {
            jQuery("#examOptions" + x).hide();
        }
        jQuery("#choice" + x).hide();
    }
    jQuery("#labelChoice").hide();
    jQuery("#labelEditChoice").hide();
    jQuery("#editAnswerContainer").show();
}
function multipleChoiceContainer()
{
    jQuery("#answerContainerSelect").hide();
    jQuery("#answerContainerText").show();
    jQuery("#labelChoice").show();
    for (var x = 0; x <= 3; x++) {
        if (x <= 2) {
            jQuery("#examOptions" + x).show();
        }
        jQuery("#choice" + x).show();
    }
    jQuery("#labelEditChoice").show();
    jQuery("#editAnswerContainer").show();
}
function essayContainer()
{
    jQuery("#answerContainerSelect").hide();
    jQuery("#answerContainerText").hide();
    for (var x = 0; x <= 3; x++) {
        if (x <= 2) {
            jQuery("#examOptions" + x).hide();
        }
        jQuery("#choice" + x).hide();
    }
    jQuery("#labelChoice").hide();
    jQuery("#editAnswerContainer").hide();
    jQuery("#labelEditChoice").hide();
}
function filterChooseQuestion()
{
    clearEditText();
    jQuery.ajax({
        cache: false,
        type: "post",
        url: "common/ajax/filterChooseQuestion.php",
        data: {
            examID: jQuery("#examID").val(),
            lessonID: jQuery("#lessonID").val(),
            examType: jQuery("#examType").val()
        },
        success: function (selectOption) {
            jQuery("#chooseQuestion").empty().append(selectOption);
        },
        error: function (data) {
        }
    });
}
function clearText()
{
    jQuery("#selectAnswer").val("Choose...");
    jQuery("#points").val("1");
    jQuery("#question").val("");
    jQuery("#answer").val("");
    for (var x = 0; x <= 2; x++) {
        jQuery("#examOptions" + x).val("");
    }
}
function clearEditText()
{
    jQuery("#editAnswer").val("");
    jQuery("#editPoints").val("");
    // jQuery("#editQuestion").val("");
    for (var x = 0; x <= 3; x++) {
        jQuery("#choice" + x).val("");
    }
}
function hideContainer()
{
    jQuery("#answerContainerSelect").hide();
    jQuery("#answerContainerText").hide();
    jQuery("#examOptions0").hide();
    jQuery("#examOptions1").hide();
    jQuery("#examOptions2").hide();
    jQuery("#labelChoice").hide();
    jQuery("#choice0").hide()
    jQuery("#choice1").hide()
    jQuery("#choice2").hide()
    jQuery("#choice3").hide()
    jQuery("#labelEditChoice").hide();
}