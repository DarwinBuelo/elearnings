<?php
$lid = Util::getParam('lid');
$Lesson = Lesson::load($lid);
//will load the details about the lesson
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4 ">
            <h3 class="text-center">
                <?= $Lesson->getTitle() ?>
            </h3>
            <h6 class="text-center pb-4">
                <i ><?= $Lesson->getOverView(); ?></i>
            </h6>
            <div class="row bg-light">
                <div class="col-md-12  mt-5 list-unstyled px-5">
                    <?php
                    echo $Lesson->toHTML($Lesson->getContent());
                    ?>
                </div>
            </div>
            <div class="row"
        </div>
    </div>
</div>
