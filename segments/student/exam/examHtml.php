<div class="counter">
    <div style="" class="container">
        <div class="row">
        </div>
        <div class="counter_form" style="padding-bottom: 5vh; padding-top: 5vh;">
            <div class="row fill_height">
                <div class="col fill_height">
                    <div class="examForm">
                    <form method="post" id="formExam">
                        <div class="counter_form_title" id="questionTitle">Question:</div>
                        <input type="hidden" id="hash" value="<?= $_SESSION['hash']; ?>">
                        <div><p class="col-9" id="question"></p></div>
                        <div id="booleanChoice">
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice" value="0"><span id="choice0"></span>
                            </div>
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice" value="1"><span id="choice1"></span>
                            </div>
                        </div>
                        <div id="multipleChoice">
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice" value="2"><span id="choice2"></span>
                            </div>
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice" value="3"><span id="choice3"></span>
                            </div>
                        </div>
                        <div id="essayChoice">
                            <textarea id="essayAnswer" style="height: 20vh; width: 45vw;"></textarea>
                        </div>
<!--                        <button type="submit" id="back">Back</button>-->
                        <button type="submit" id="next">Next</button>
                        <button type="submit" id="finish" class="finish">Finish</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>