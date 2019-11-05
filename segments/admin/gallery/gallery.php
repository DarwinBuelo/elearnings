<?php
// will handle the gallery uploader

?>


<div class="row p-2">
    <div class="col-md-6">
        <h3>Gallery</h3>
    </div>
    <div class="col-md-6 text-md-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-image"></i> Add Image</button>
    </div>
</div>

<div class="row">
    <?php
    // get the files
    $html = '';
    $files = Gallery::getImages();

    if (count($files) > 0) {
        foreach ($files as $file) {
            $html .= '<div class="col-md-4 text-md-center p-5">';
            $html .= "<img src='images/gallery/{$file['filename']}' width='200px' class=''><br>";
            $html .= $file['description'];
            $html .= '</div>';
        }
    }
    echo $html;
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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