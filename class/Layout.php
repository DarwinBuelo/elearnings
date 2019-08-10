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
        $this->favicon = $file;
    }
}