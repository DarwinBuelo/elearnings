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

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_image"><img src="images/blog_1.jpg" alt=""></div>
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">Here’s What You Need to Know About Online Testing</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">With Changing Students and Times</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_video_container">
                            <video class="blog_post_video video-js" data-setup='{"controls": true, "autoplay": false, "preload": "auto", "poster": "images/blog_2.jpg"}'>
                                <source src="images/mov_bbb.mp4" type="video/mp4">
                                <source src="images/mov_bbb.ogg" type="video/ogg">
                                Your browser does not support HTML5 video.
                            </video>
                        </div>
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">Building Skills Outside the Classroom With New Ways</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_image"><img src="images/blog_3.jpg" alt=""></div>
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">Law Schools Debate a Contentious Testing Alternative</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_video_container">
                            <video class="blog_post_video video-js" data-setup='{"controls": true, "autoplay": false, "preload": "auto", "poster": "images/blog_4.jpg"}'>
                                <source src="images/mov_bbb.mp4" type="video/mp4">
                                <source src="images/mov_bbb.ogg" type="video/ogg">
                                Your browser does not support HTML5 video.
                            </video>
                        </div>
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">Building Skills Outside the Classroom With New Ways</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_image"><img src="images/blog_5.jpg" alt=""></div>
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">Here’s What You Need to Know About Online Testing</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post -->
                    <div class="blog_post trans_200">
                        <div class="blog_post_body">
                            <div class="blog_post_title"><a href="blog_single.php">With Changing Students and Times</a></div>
                            <div class="blog_post_meta">
                                <ul>
                                    <li><a href="#">admin</a></li>
                                    <li><a href="#">november 11, 2017</a></li>
                                </ul>
                            </div>
                            <div class="blog_post_text">
                                <p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take...</p>
                            </div>
                        </div>
                    </div>

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