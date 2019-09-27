<div class="counter">
    <div style="" class="container">
        <div class="row">
        </div>
        <div class="counter_form" style="padding-bottom: 5vh; padding-top: 5vh;">
            <div class="row fill_height">
                <div class="col fill_height">
                    <div class="examForm">
                    <form action="#" method="post" id="formExam">
                        <div class="counter_form">
                            <div class="counter_form_title">Question:</div>
                            <input type="hidden" id="hash" value="<?= $_SESSION['hash']; ?>">
                            <div><p class="col-6" id="question"></p></div>
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice"><span id="choice0"></span>
                            </div>
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice"><span id="choice1"></span>
                            </div>
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice"><span id="choice2"></span>
                            </div>
                            <div>
                                <input type="radio" name="radioChoice" id="radioChoice"><span id="choice3"></span>
                            </div>
                            <button type="submit" id="back">Back</button>
                            <button type="submit" id="next">Next</button>
                            <button id="finish">Finish</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>