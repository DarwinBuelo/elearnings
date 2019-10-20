<?php
if (Util::getParam('task')) {
    require 'segments/teacher/uploadFiles/uploadHandler.php';
}
?>

<div class="row bg-light">
    <div class="col-md-12 text-center m-2">
        <h3>Uploaded Files</h3>
    </div>
</div>
<div class="row bg-light">
    <div class="col-md-12 text-center m-3"><button class="btn btn-danger" id="uploadTriggerModal">Upload File</button></div>
</div>

<!-- List of uploaded Files -->
<div class="row bg-white">
    <div class="col-md-12 text-center align-content-center">
        <?php
            $FilesObj = FileManager::LoadArray();
            $html  ="";
            foreach($FilesObj as $File){
                $html .="<div class='col-md-3 m-1 bg-flat-color-3'>";
                $html .= "<div class='row'>";
                $html .= "<div class='col-md-12 mt-2' style='max-height: 300px ; min-height: 300px'>";
                if($File->getType() == "video"){
                    $html .= "<video style='width: 100% ' controls><source src='/public/video/".$File->getName()."' type='video/mp4'><video>";
                }else{
                    $html .= "<i>Document Icon</i>";
                }
                $html .= "</div>";
                $html .= "<div class='row'>";
                $html .= "</div>";
                $html .= "</div>";
                $html .="</div>";
            }
            echo $html;
        ?>
    </div>
</div>

<div class="modal myModal" tabindex="-1" role="dialog" style="background: #0000007a">
    <div class="modal-dialog" role="document">
        <form id="uploadModalForm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>?page=uploadFiles" enctype="multipart/form-data">
            <input type="hidden" name="task" value="true">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="uploadTriggerModalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" name="fileToUpload" accept="video/mp4 ,application/pdf">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" id="uploadTriggerModalClose" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    jQuery(document).ready(function () {

        //modal show
        jQuery('#uploadTriggerModal').click(function () {
            jQuery('.modal').fadeIn();
        });

        // modal hide
        jQuery('[id=uploadTriggerModalClose]').click(function(){
            jQuery('#uploadModalForm').trigger("reset");
            jQuery('.modal').fadeOut();
        });

        
    });
</script>