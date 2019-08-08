<?php

/**
 * Class Layout
 * this will hold everything about the layout
 */
class Layout
{
    protected $css =[];
    protected $js = [];
    protected $companyName = 'Test Company';
    protected $companyDesc =  'Test Description';

    function __construct($companyName, $companyDesc = null, $css = null, $js = null)
    {
        $this->setCompanyName($companyName);
        if (!empty($companyDesc)) {
            $this->$companyDesc = $companyDesc;
        }
        if (!empty($css)) {
            $this->addCSS($css);
        }
        if (!empty($js)) {
            $this->addJS($js);
        }
    }

    /**
     * Create the header of the system
     */
    public function header($page = null)
    {
        /**
         * @TODO add favicon
         */
        ?>
            <!DOCTYPE HTML>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <?php
                foreach ($this->css as $css) {
                    ?><link rel="stylesheet" href="<?= $css ?>"><?php
                }
                ?>
                <title><?=  (isset($page) ? $page : null) ?><?= !empty($this->companyName) ? '-'.$this->companyName : null?></title>
            </head><?php
    }

    /**
     * Create the footer and include the JS needed in the system
     */
    public function footer()
    {
        echo ' 
        <!--== SlideshowBg Area End ==-->
        <!--== Footer Area Start ==-->
        <!-- <section id="footer-area"> -->
            <!-- Footer Widget Start -->
            <!-- <div class="footer-widget-area">
                <div class="container">
                    <div class="row"> -->
                        <!-- Single Footer Widget Start -->
                        <!-- <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget">
                                <h2>About Us</h2>
                                <div class="widget-body">
                                    <img src="assets/img/logo.png" alt="JSOFT">
                                    <p>Lorem ipsum dolored is a sit ameted consectetur adipisicing elit. Nobis magni assumenda distinctio debitis, eum fuga fugiat error reiciendis.</p>
    
                                    <div class="newsletter-area">
                                        <form action="index.html">
                                            <input type="email" placeholder="Subscribe Our Newsletter">
                                            <button type="submit" class="newsletter-btn"><i class="fa fa-send"></i></button>
                                        </form>
                                    </div>
    
                                </div>
                            </div>
                        </div> -->
                        <!-- Single Footer Widget End -->
    
                        <!-- Single Footer Widget Start -->
                        <!-- <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget">
                                <h2>Recent Posts</h2>
                                <div class="widget-body">
                                    <ul class="recent-post">
                                        <li>
                                            <a href="#">
                                               Hello Bangladesh! 
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                              Lorem ipsum dolor sit amet
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                               Hello Bangladesh! 
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                consectetur adipisicing elit?
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                        <!-- Single Footer Widget End -->
    
                        <!-- Single Footer Widget Start -->
                        <!-- <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget">
                                <h2>get touch</h2>
                                <div class="widget-body">
                                    <p>Lorem ipsum doloer sited amet, consectetur adipisicing elit. nibh auguea, scelerisque sed</p>
    
                                    <ul class="get-touch">
                                        <li><i class="fa fa-map-marker"></i> 800/8, Kazipara, Dhaka</li>
                                        <li><i class="fa fa-mobile"></i> +880 01 86 25 72 43</li>
                                        <li><i class="fa fa-envelope"></i> kazukamdu83@gmail.com</li>
                                    </ul>
                                    <a href="https://goo.gl/maps/b5mt45MCaPB2" class="map-show" target="_blank">Show Location</a>
                                </div>
                            </div>
                        </div> -->
                        <!-- Single Footer Widget End -->
                    <!-- </div>
                </div>
            </div> -->
            <!-- Footer Widget End -->
    
            <!-- Footer Bottom Start -->
            <!-- Footer Bottom End -->
        <!-- </section> -->
        <!-- == Footer Area End == -->
        <!--== Scroll Top Area Start ==-->
        <div class="scroll-top">
            <img src="assets/img/scroll-top.png" alt="JSOFT">
        </div>
        <!--== Scroll Top Area End ==-->';
        if (count($this->js) > 0) {
            foreach ($this->js as $js) {
                ?><script src="<?= $js ?>"></script><?php
            }
        }
        ?></body></html><?php
    }

    /**
     * @param $path string / array
     */
    public function addCSS($path)
    {
        if (is_array($path)) {
            foreach ($path as $file) {
                $this->css[] = $file;
            }
        }
        $this->css[] = $path;
    }

    /**
     * @param $path string /array
     */
    public function addJS($path)
    {
        if (is_array($path)) {
            foreach ($path as $file) {
                $this->js[] =  $file;
            }
        } else {
            $this->js[] = $path;
        }
    }

    /**
     * @param $name string
     */
    public function setCompanyName($name)
    {
        $this->companyName = $name;
    }

    /**
     * @param $desc string
     */
    public function setCompanyDescription($desc)
    {
        $this->companyDesc =  $desc;
    }

    /**
     * @return array
     */
    public function getCSS()
    {
        return $this->css;
    }

    /**
     * @return array
     */
    public function getJS()
    {
        return $this->js;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    public static function navigationBar()
    {
        echo '<!--== Preloader Area Start ==-->
        <div class="preloader">
            <div class="preloader-spinner">
                <div class="loader-content">
                    <-- <img src="assets/img/preloader.gif" alt="JSOFT"> -->
                </div>
            </div>
        </div>
        <!--== Preloader Area End ==-->
        <!--== Header Area Start ==-->
        <header id="header-area" class="fixed-top">
                <!--== Header Top Start ==-->
                <div id="header-top" class="d-none d-xl-block">
                    <div class="container">
                        <div class="row">
                            <!--== Single HeaderTop Start ==-->
                            <div class="col-lg-3 text-left">
                                <i class="fa fa-map-marker"></i> Legazpi City, Albay
                            </div>
                            <!--== Single HeaderTop End ==-->
        
                            <!--== Single HeaderTop Start ==-->
                            <div class="col-lg-3 text-center">
                                <i class="fa fa-mobile"></i> +480 12 95
                            </div>
                            <!--== Single HeaderTop End ==-->
        
                            <!--== Single HeaderTop Start ==-->
                            <div class="col-lg-3 text-center">
                                <i class="fa fa-clock-o"></i> Mon-Fri 09.00 - 17.00
                            </div>
                            <!--== Single HeaderTop End ==-->
        
                            <!--== Social Icons Start ==-->
                            <div class="col-lg-3 text-right">
                                <div class="header-social-icons">
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                            <!--== Social Icons End ==-->
                        </div>
                    </div>
                </div>
                <!--== Header Top End ==-->
        
                <!--== Header Bottom Start ==-->
                <div id="header-bottom">
                    <div class="container">
                        <div class="row">
                            <!--== Logo Start ==-->
                            <div class="col-lg-4">
                                <a href="index.html" class="logo">
                                    <img src="assets/img/busLogo.ico" alt="JSOFT">
                                </a>
                            </div>
                            <!--== Logo End ==-->
        
                            <!--== Main Menu Start ==-->
                            <div class="col-lg-8 d-none d-xl-block">
                                <nav class="mainmenu alignright">
                                    <ul>
                                        <li class="active"><a href="index.php">Home</a></li>
                                        <!-- <li><a href="about.html">About</a></li> -->
                                        <li><a href="#">About</a></li>
                                        <li><a href="services.html">Schedule</a></li>
                                        <li><a href="#">Bus</a></li>
                                        <li><a href="#">Go to</a>
                                            <ul>
                                                <!-- <li><a href="package.html">Pricing</a></li> -->
                                                <li><a href="#">Pricing</a></li>
                                                <!-- <li><a href="driver.html">Driver</a></li> -->
                                                <li><a href="#">Driver</a></li>
                                                <!-- <li><a href="faq.html">FAQ</a></li> -->
                                                <!-- <li><a href="gallery.html">Gallery</a></li> -->
                                                <!-- <li><a href="help-desk.html">Help Desk</a></li> -->
                                                <li><a href="login.php">Log In</a></li>
                                                <li><a href="register.php">Register</a></li>
                                                <!-- <li><a href="404.html">404</a></li> -->
                                            </ul>
                                        </li>
                                        <li><a href="#">Blog</a>
                                            <ul>
                                                <!-- <li><a href="article.html">Blog Page</a></li> -->
                                                <!-- <li><a href="article-details.html">Blog Details</a></li> -->
                                            </ul>
                                        </li>
                                        <li><a href="#">Contact</a></li> 
                                        <!-- <li><a href="contact.html">Contact</a></li> -->
                                    </ul>
                                </nav>
                            </div>
                            <!--== Main Menu End ==-->
                        </div>
                    </div>
                </div>
                <!--== Header Bottom End ==-->
            </header>
            <!--== Header Area End ==-->';
    }
}
