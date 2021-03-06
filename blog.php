<?php
include 'init.php';
$Outline->addCSS('plugins/video-js/video-js.css');
$Outline->addCSS('styles/blog.css');
$Outline->addCSS('styles/blog_responsive.css');
$Outline->header('Blog');
$Outline->navigationBar('Blog');

?>
<!-- Blog -->

<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog_post_container">

                    <?php
                    // get the files
                    $html = '';
                    $files = Gallery::getImages();

                    if (count($files) > 0) {
                        foreach ($files as $file) {
                            ?>

                            <!-- Blog Post -->
                            <div class="blog_post trans_200">
                                <div class="blog_post_image"><img src="images/gallery/<?= $file['filename'] ?>" alt=""></div>
                                <div class="blog_post_body">

                                    <div class="blog_post_text">
                                        <p><?= $file['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <div class="load_more trans_200"><a href="#">load more</a></div>
            </div>
        </div>
    </div>
</div>
<?php
$Outline->addJS('plugins/masonry/masonry.js');
$Outline->addJS('plugins/video-js/video.min.js');
$Outline->addJS('js/blog.js');
$Outline->footer();
//EOF