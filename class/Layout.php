<?php
/**
 * Class Container
 * @author Darwin Buelo dbuelo@gmail.com
 * @since 14/07/2019
 * @version 1.0
 */
class Layout
{
    protected $language = 'en';
    protected $css      = [];
    protected $head;
    protected $headEnd;
    protected $js       = [];
    protected $favicon;

    /**
     * this render the header
     */
    public function header()
    {
<<<<<<< HEAD
        $this->setHead();
        $html = $this->head;
        // set logo favicon
        if (isset($this->favicon)) {
            $html .= sprintf("<link rel='icon' type='image/png' href='%s'>",$this->getFavIcon());
        }
        // create the css
        $list = $this->css;
        if (count($list) > 0) {
            foreach ($list as $file) {
                $html .= sprintf('<link rel="stylesheet" href="%s">', $file);
                $html .= PHP_EOL;
            }
        }
=======
        /**
         * @TODO add favicon
         */
        ?>
            <!DOCTYPE HTML>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="description" content="Unicat project">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <?php
                foreach ($this->css as $css) {
                    ?><link rel="stylesheet" type="text/css" href="<?= $css ?>"><?php
                }
                ?>
                <title><?=  (isset($page) ? $page : null) ?><?= !empty($this->companyName) ? '-'.$this->companyName : null?></title>
            </head>
        <body>
        <?php
        $this->navigationBar($page);
    }

    /**
     * Create the footer and include the JS needed in the system
     */
    public function footer()
    {
        echo '<!-- Footer -->
        <footer class="footer">
            <div class="footer_background" style="background-image:url(images/footer_background.png)"></div>
            <div style="padding-left: 15vw;"  class="container">
                <div class="row footer_row">
                    <div class="col">
                        <div class="footer_content">
                            <div class="row">

                                <div class="col-lg-3 footer_col">

                                    <!-- Footer About -->
                                    <div class="footer_section footer_about">
                                        <div class="footer_logo_container">
                                            <a href="#">
                                                <div class="footer_logo_text">Pia<span>Gotsky</span></div>
                                            </a>
                                        </div>
                                        <div class="footer_about_text">
                                            <p>Piagotsky Tutorial and Development Center.</p>
                                        </div>
                                        <div class="footer_social">
                                            <ul>
                                                <li><a href="https://www.facebook.com/pg/Piagotsky-Tutorial-and-Development-Center-711856805676639/posts/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                             <!--   <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-3 footer_col">

                                    <!-- Footer Contact -->
                                    <div class="footer_section footer_contact">
                                        <div class="footer_title">Contact Us</div>
                                        <div class="footer_contact_info">
                                            <ul>
                                                <li>Email: piagotsky2017@gmail.com</li>
                                                <li>Phone:  742-6741</li>
                                                <li>Casa Erin bldg 2, Rizal St. Cabangan, Legazpi City</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-6 footer_col">

                                    <!-- Footer links -->
                                    <div class="footer_section footer_links">
                                        <div class="footer_title">About</div>
                                            <div class="footer_about_text">
                                                <p>About First of its kind in the province. Combining the power of technology and knowledge to bring about a 21st century learning experience.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row copyright_row">
                    <div class="col">
                        <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>';
>>>>>>> 7b256db5d05427161a267bdbf6d5e4f3a6b0c333
        if (count($this->js) > 0) {
            foreach ($this->js as $jsFile) {
                $html .= sprintf("<script src='%s'></script>\n",$jsFile);
                $html .= PHP_EOL;
            }
        }
        $html .= '</head><body>';

        print $html;
    }

    /**
     * @TODO create a function that will render html tags with attributes
     * and also provide nested element
     */
    public function render($element, $attributes, $value = null)
    {
        echo sprintf('<%s ', $element);
        //render attributes
        if (count($attributes) > 0) {
            foreach ($attributes as $key => $attribute) {
                echo $key.'="'.$attribute.'"';
            }
        }
        echo ">";
        if (!empty($value)) {
            echo $value;
            echo sprintf('</%s>', $element);
        }
    }

    protected function setHead($data = null)
    {
        if (empty($data)) {
            $data = "<!DOCTYPE html><html lang='{$this->language}'><head>";
            $data .= '<title>'.COMPANY_NAME.'</title>';
            $data .= '<meta charset="utf-8">';
            $data .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
            $data .= '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
        }

        $this->head = $data;
    }


    public function footer()
    {
        echo "</body></html>";
    }

    public function addCss($filePath)
    {
        if (is_array($filePath)) {
            foreach ($filePath as $file) {
                $this->css[] = $file;
            }
        } else {
            $this->css[] = $filePath;
        }
    }

    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param $path string /array
     */
    public function addJS($filePath)
    {
        if (is_array($filePath)) {
            foreach ($filePath as $file) {
                $this->js[] = $file;
            }
        } else {
            $this->js[] = $filePath;
        }
    }

    public function getFavIcon()
    {
        return $this->favicon;
    }

    public function setFavIcon($file)
    {
<<<<<<< HEAD
        $this->favicon = $file;
=======
        $navBars = [
            'index.php' => 'Home',
            'about.php' => 'About',
            'courses.php' => 'Courses',
            'blog.php' => 'Blog',
            '#' => 'Page',
            'contact.php' => 'Contact'
        ];
        $navigationBar = [];
        $mobileMenuBar = [];
        foreach ($navBars as $key => $value) {
            switch($activeNavbar) {
                case $value:
                    $navigationBar[] = '<li class="active"><a href="'.$key.'">'.$value.'</a></li>';
                    $mobileMenuBar[] = '<li class="menu_mm"><a href="'.$key.'">'.$value.'</a></li>';
                    break;
                case 'Login':
                    $navigationBar[] = '<li><a href="'.$key.'">'.$value.'</a></li>';
                    $mobileMenuBar[] = '<li class="menu_mm"><a href="'.$key.'">'.$value.'</a></li>';
                    break;
                default:
                    $navigationBar[] = '<li><a href="'.$key.'">'.$value.'</a></li>';
                    $mobileMenuBar[] = '<li class="menu_mm"><a href="'.$key.'">'.$value.'</a></li>';
                    break;
            }
        }
        $locationStatus = '<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>'.$activeNavbar.'</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';
        $locationStatus = ($activeNavbar === 'Home' || $activeNavbar === 'Login' ? '' : $locationStatus);

        echo '<div class="super_container">
        <header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<ul class="top_bar_contact_list">
									<li><div class="question">Have any questions?</div></li>
									<li>
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div>742-6741</div>
									</li>
									<li>
										<i class="fa fa-envelope-o" aria-hidden="true"></i>
										<div>piagotsky2017@gmail.com</div>
									</li>
								</ul>
								<div class="top_bar_login ml-auto">
									<div class="login_button"><a href="login.php">Login</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="#">
									<div class="logo_text">Pia<span>Gotsky</span></div>
								</a>
							</div>
                            <nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									'.implode('',$navigationBar).'
								</ul>
								<!-- Hamburger -->
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Search Panel -->
		<div class="header_search_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_search_content d-flex flex-row align-items-center justify-content-end">
							<form action="#" class="header_search_form">
								<input type="search" class="search_input" placeholder="Search" required="required">
								<button class="header_search_button d-flex flex-column align-items-center justify-content-center">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>			
		</div>			
	</header>
	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
			    '.implode('',$mobileMenuBar).'
			</ul>
		</nav>
	</div>
	'.$locationStatus;
>>>>>>> 7b256db5d05427161a267bdbf6d5e4f3a6b0c333
    }
}