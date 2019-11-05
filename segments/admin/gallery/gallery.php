<?php
// will handle the gallery uploader

?>


<div class="row p-2">
    <div class="col-md-6">
        <h3>Gallery</h3>
    </div>
    <div class="col-md-6 text-md-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal"><i
                    class="fa fa-image"></i> Add Image
        </button>
    </div>
</div>

<div class="row">
    <?php
    // get the files
    $html = '';
    $files = Gallery::getImages();

    if (count($files) > 0) {
        foreach ($files as $file) {
            $html .= '<div class="col-md-4 text-md-center p-5" id="container'.$file['image_id'].'">';
            $html .= '<div class="card text-center">';
            $html .= "<div class='col-md-12'><div class='deleteItem close ' id='deleteItem' data-id='{$file['image_id'] }'>x</div></div>";

            $html .= "<img src='images/gallery/{$file['filename']}' width='200px' class='' id='image' data-id='" . $file['image_id'] . "' data-desc='" . $file['description'] . "'><br>";
            $html .= '<div id="desc' . $file['image_id'] . '">' . $file['description'] . '</div>';
            $html .= '</div></div>';
        }
    }
    echo $html;
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="process.php" enctype='multipart/form-data'>
                    <input type="hidden" name="task" value="uploadGallery">
                    <br>
                    <input type="file" name="imageToUpload">
                    <br>
                    Description :<br>
                    <textarea width="458px" name="description"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="custom_modal" id="uploadModalEdit">
    <div class=" modalbox">
        <div class="modal-headers">
            <h4>Edit Description</h4>
        </div>
        <div class="modal-contents">
            <form action="" id="editForm">
                <input type="hidden" id="itemID" value="">
                <textarea name="description" id="editDesc"></textarea>
            </form>
        </div>
        <div class="modal-footers">

            <button class="btn btn-success" id="saveEdit"> Save</button>
            <button class="btn btn-danger" id="closeEdit"> Close</button>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function () {
        jQuery('[id="image"]').click(function () {
            jQuery('#uploadModalEdit').fadeIn();
            jQuery('#itemID').val(jQuery(this).data('id'));
            jQuery('#editDesc').val(jQuery(this).data('desc'));
        });

        jQuery('[id="deleteItem"]').click(function () {
            var id =jQuery(this).data('id');
            jQuery.ajax({
                url: 'process.php',
                method: 'POST',
                data: {
                    task: 'deleteImage',
                    imageID: id
                },
                success: function (response) {
                    jQuery('#container'+id).remove();

                },
                error: function (response) {
                    console.log('error : ' + response);
                }
            });
        });


        jQuery('#closeEdit').click(function () {
            jQuery('#editForm').trigger("reset");
            jQuery('#uploadModalEdit').fadeOut();
        });

        jQuery('#saveEdit').click(function () {
            jQuery.ajax({
                url: 'process.php',
                method: 'POST',
                data: {
                    task: 'editImage',
                    imageID: jQuery('#itemID').val(),
                    desc: jQuery('#editDesc').val()
                },
                success: function (response) {
                    jQuery('#desc' + jQuery('#itemID').val()).html(jQuery('#editDesc').val());
                    jQuery('#editForm').trigger("reset");
                    jQuery('#uploadModalEdit').fadeOut();

                },
                error: function (response) {
                    console.log('error : ' + response);
                }
            });


        });
    });
</script>