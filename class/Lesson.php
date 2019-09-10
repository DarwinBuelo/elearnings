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
            '~\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
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
            '<span style="font-size:$1px;">$2</span>',
            '<span style="color:$1;">$2</span>',
            '<a href="$1">$1</a>',
            '<img width="$1" height="$2" src="$3" alt="" />',
            '<img src="$1" alt="" />'
        );
        // Replacing the BBcodes with corresponding HTML tags
        return preg_replace($find, $replace, $text);

    }

}