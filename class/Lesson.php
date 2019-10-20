<?php

/**
 * Class Lesson
 *
 * all about the lessons
 */
class Lesson extends LessonInterface
{

    public function toHTML($bbtext)
    {
        $text = strip_tags($bbtext);
        // BBcode array
        $find = array(
            '~\[b\](.*?)\[/b\]~s',
            '~\[i\](.*?)\[/i\]~s',
            '~\[u\](.*?)\[/u\]~s',
            '~\[center\](.*?)\[/center\]~s',
            '~\[ol\](.*?)\[/ol\]~s',
            '~\[li\](.*?)\[/li\]~s',
            '~\[quote\]([^"><]*?)\[/quote\]~s',
            '~\[size=([^"><]*?)\](.*?)\[/size\]~s',
            '~\[color=([^"><]*?)\](.*?)\[/color\]~s',
            '~\[url\]((?:ftp|https?)://[^"><]*?)\[/url\]~s',
            '~\[img width=(.*?) height=(.*?)\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
            '~\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
            '~\[youtube\](.*?)\[/youtube\]~s',
            '~\[font=([^"><]*?)\](.*?)\[/font\]~s',
            '~\[hr]~s',
             '~\[right\](.*?)\[/right\]~s',
        );
        // HTML tags to replace BBcode
        $replace = array(
            '<b>$1</b>',
            '<i>$1</i>',
            '<span style="text-decoration:underline;">$1</span>',
            '<p style="text-align: center">$1</p>',
            '<ol>$1</ol>',
            '<li >$1</li>',
            '<pre>$1</'.'pre>',
            '<font size="$1">$2</font>',
            '<span style="color:$1;">$2</span>',
            '<a href="$1">$1</a>',
            '<img width="$1" height="$2" src="$3" alt="" />',
            '<img src="$1" alt="" />',
            '<iframe width="420" height="315" src="https://www.youtube.com/embed/$1?wmode=opaque" ></iframe>',
            '<font face="$1">$2</font>',
            '<hr>',
            '<div align="right">$1</div>'
        );
        // Replacing the BBcodes with corresponding HTML tags
        return preg_replace($find, $replace, $text);

    }

}