<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: Rss2 生成类
 ***********************************************************/

class Rss2Gen {

    var $rss_header;  //RSS文档头，存放一个<rss>根元素及其version属性。
    var $item;
    var $items;
    var $channel_header; //频道的头部信息，存放频道名称、URL、描述、语言、版权等等。
    //--------------- 以下元素是可选的频道子元素 --------------//
    var $channel_language; //频道使用的语言种类，例如en-us、zh-cn等，放便聚集器组织中一语言的站点。
    var $channel_copyright; //频道内容的版权声明。
    var $channel_managingEditor; //对该频道内容负责的个人的Email地址
    var $channel_webMaster;   //对该频道的技术支持负责的个人的Email地址
    var $channel_pubDate;   //该频道内容的公布日期
    var $channel_lastBuildDate;  //上次频道内容更改的时间
    var $channel_category;   //说明频道属于哪一个或多个分类
    var $channel_docs;   //RSS文件所使用格式的说明文档所在的URL
    var $channel_cloud;   //允许进程注册为“cloud”，频道更新时通知它
    var $channel_ttl;   //ttl 代表存活时间，存活时间是一个数字，表示提要在刷新之前缓冲的分钟数
    var $channel_image;   //指定一个能在频道中显示的GIF、JPEG 或PNG 图像
    var $channel;   //整个rss2文档信息，用与生成整个页面。
    var $halt_on_error = true;
    var $encoding;

    /**
    * 构造函数，其参数皆为rss2必须的频道子元素，如果不填，则为默认内容。
    *
    * @param String $title 频道的名称，频道的title应该和web站点的title尽量一致。
    * @param String $link 与该频道关联的web站点的URL。
    * @param String $description 对频道的一段简单描述，如介绍频道是做什么的。
    * @access public
    */
    function Rss2Gen($encoding) {
        $this->encoding = $encoding;
        $this->fillHeader();
    }

    /**
    * 生成RSS文档头，必须以一个<rss>元素作为根元素，其有一个强制属性version，指定当前文档遵守的RSS版本。
    * @access private
    */
    function fillHeader() {
        $this->rss_header = "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\r\n";
        $this->rss_header .= " <rss version=\"2.0\">\r\n";
    }

    /**
    * 设置频道头，其中三个元素为必须的。
    * @param String $title 频道的名称，频道的title应该和Web站点的title尽量一致。
    * @param String $link 与该频道关联的Web站点或者站点区域的URL。
    * @param String $description 对频道的一段简单描述，简要介绍频道是做什么的。
    */
    function setChannel($title = "exblog", $link = "http://www.exblog.org", $description = "exblog") {
        $this->channel_header = "  <title><![CDATA[".$title."]]></title>\n";
        $this->channel_header .= "  <link>".$link."</link>\r\n";
        $this->channel_header .= "  <description><![CDATA[".$description."]]></description>\r\n";
    }

    function halt($msg) {
        if ($this->halt_on_error) {
            $this->haltmsg($msg);
        }
        die("exblog RSS2 exit");
    }

    function haltmsg($msg) {
        sprintf("<b>exblog RSS2 builder ERROR: %s</b><br>\r\n", $msg);
    }

    /**
    * 设置该RSS文档的语言，默认为简体中文。
    * @access public
    */
    function setLanguage($lang = "zh_cn") {
        $this->channel_language = "  <language>".$lang."</language>\r\n";
    }

    /**
    * 频道内容的版权声明
    * @access public
    */
    function setCopyright($copyright = "exblog") {
        $this->channel_copyright = "  <copyright>".$copyright."</copyright>\r\n";
    }

    /**
    * 对该频道内容负责的个人的Email地址
    * @access public
    */
    function setManagingEditor($email = NULL) {
        if (empty($email)) {
            $this->halt("如果你设置了该频道内容负责的个人的Email地址，请填写她。");
        }
        $this->channel_managingEditor = "  <managingEditor>".$email."</managingEditor>\r\n";
    }

    /**
    * 对该频道的技术支持负责的个人的Email地址
    * @access public
    */
    function setWebMaster($email = NULL) {
        if (empty($email)) {
            $this->halt("如果你设置了该频道的技术支持负责的个人的Email地址，请填写她。 :)");
        }
        $this->channel_webMaster = "  <webMaster>".$email."</webMaster>\r\n";
    }

    /**
    * 该频道内容的公布日期。
    * @access public
    */
    function setPubDate($date = NULL) {
        if (empty($date)) {
            $date = date("Y/m/d");
            $this->channel_pubDate = "  <pubDate>".$date."</pubDate>\r\n";
        }
        $this->channel_pubDate = "  <pubDate>".$date."</pubDate>\r\n";
    }

    /**
    * 上次频道内容更改的时间
    * @access public
    */
    function setLastBuildDate($date = NULL) {
        if (empty($date)) {
            $date = date("Y/m/d");
            $this->channel_lastBuildDate = "  <lastBuildDate>".$date."</lastBuildDate>\r\n";
        }
        $this->channel_lastBuildDate = "  <lastBuildDate>".$date."</lastBuildDate>\r\n";
    }

    /**
    * 说明频道属于哪一个或多个分类
    * @access public
    */
    function setCategory($category) {
        $this->channel_category = "  <category>".$category."</category>\r\n";
    }

    /**
    * RSS文件所使用格式的说明文档所在的URL
    * @access public
    */
    function setDocs($url) {
        $this->channel_docs = "  <docs>".$url."</docs>\r\n";
    }

    /**
    * ttl 代表存活时间，存活时间是一个数字，表示提要在刷新之前缓冲的分钟数
    * @access public
    */
    function setTtl($minute) {
        $this->channel_ttl = "  <ttl>".$minute."</ttl>\r\n";
    }

    /**
    * 指定一个能在频道中显示的GIF、JPEG 或PNG 图像
    *
    * @param String $url 必需，是表示该频道的 GIF、JPEG 或 PNG 图像的URL
    * @param String $title 必需，是图象的描述。当频道以 HTML 呈现时，用作 HTML <image> 标签的 ALT 属性。
    * @param String $link 必需，是站点的 URL。如果频道以 HTML 呈现，该图像作为到这个站点的链接。
    * @param Integer $width 表示图象的像素宽，必须和 $height 一同设置，否则不会显示此属性。
    * @param Integer $height 表示图象的像素高，必须和 $width 一同设置，否则不会显示此属性。
    * @param String $description 围绕着该图像形成的链接元素的 title 属性。
    *
    * @access public
    */
    function setChannelImage($url, $title, $link, $width = NULL, $height = NULL, $description = NULL) {
        if (!isset($url))
            $this->halt("如果你要设置图片，该图像地址属性必须填写。");
        if (!isset($title))
            $this->halt("如果你要设置图片，该图像描述属性必须填写。");
        if (!isset($link))
            $this->halt("如果你要设置图片，该图像链接属性必须填写。这个URL一般和图像地址属性相同");
        $this->channel_image = "  <image>\r\n";
        $this->channel_image .= "   <url>".$url."</url>\r\n";
        $this->channel_image .= "   <title><![CDATA[".$title."]]></title>\r\n";
        $this->channel_image .= "   <link>".$link."</link>\r\n";
        //如果设置了图像宽、高则添加此属性。
        if (!empty($width) && !empty($height)) {
            $this->channel_image .= "   <width>".$width."</width>\r\n";
            $this->channel_image .= "   <height>".$height."</height>\r\n";
        }
        if (!empty($description))
            $this->channel_image .= "   <description><![CDATA[".$description."]]></description>\r\n";
        $this->channel_image .= "</image>\r\n";
    }

    /**
    * 添加一条item到channel中，虽然item的子元素都是可选的，但至少要存在一个title或description
    *
    * @param String $title 项（item）的标题
    * @param String $description 项（item）的大纲
    * @param String $link 项（item）的URL
    * @param String $author 项（item）作者的Email 地址
    * @param String $category 包括项（item）的一个或多个分类
    * @param String $comments 关于项（item）的注释页的URL
    * @param String $enclosure 支持和该项（item）有关的媒体对象
    * @param String $guid 唯一与该项（item）联系在一起的永久性链接
    * @param String $pubDate 该项（item）是什么时候发布的
    * @param String $Source 该项（item）来自哪个RSS 频道，当把项（item）聚合在一起时非常有用
    *
    * @access public
    */
    function addItem($title = NULL,
                     $description = NULL,
                     $link = NULL,
                     $author = NULL,
                     $category = NULL,
                     $comments = NULL,
                     $enclosure = NULL,
                     $guid = NULL,
                     $pubDate = NULL,
                     $source = NULL) {
        //判断是否至少添加了title或description
        if (empty($title) && empty($description)) {
            $this->halt("item:请至少设置title或description属性。");
        }
        else {
            $this->item = "  <item>\r\n";
            if (!empty($title))
                $this->item .= "   <title><![CDATA[".$title."]]></title>\r\n";
            if (!empty($link))
                $this->item .= "   <link>".$link."</link>\r\n";
            if (!empty($description))
                $this->item .= "   <description><![CDATA[".$description."]]></description>\r\n";
            if (!empty($author))
                $this->item .= "   <author><![CDATA[".$author."]]></author>\r\n";
            if (!empty($category))
                $this->item .= "  <category><![CDATA[".$category."]]></category>\r\n";
            if (!empty($comments))
                $this->item .= "   <comments><![CDATA[".$comments."]]></comments>\r\n";
            if (!empty($enclosure))
                $this->item .= "   <enclosure><![CDATA[".$enclosure."]]></enclosure>\r\n";
            if (!empty($guid))
                $this->item .= "   <guid>".$guid."</guid>\r\n";
            if (!empty($pubDate))
                $this->item .= "   <pubDate>".$pubDate."</pubDate>\r\n";
            if (!empty($source))
                $this->item .= "   <source><![CDATA[".$source."]]></source>\r\n";
            $this->item .= "</item>\r\n";
        }
        $this->items .= $this->item;
    }

    /**
    * 输出 rss2 文档
    */
    function builder() {
        $this->stuff();
        header("Content-type:application/xml");
        print $this->channel;
    }

    /**
    * 兼容老版本rss生成方法，去掉了写文件功能。
    *
    */
    function buildRssFeed($param = NULL) {
        $this->builder();
    }

    /**
    * 合成整个RSS2文档
    *
    */
    function stuff() {
        $this->channel = $this->rss_header;
        $this->channel .= $this->channel_header;
        if (isset($this->channel_language))
            $this->channel .= $this->channel_language;
        if (isset($this->channel_copyright))
            $this->channel .= $this->channel_copyright;
        if (isset($this->channel_managingEditor))
            $this->channel .= $this->channel_managingEditor;
        if (isset($this->channel_webMaster))
            $this->channel .= $this->channel_webMaster;
        if (isset($this->channel_pubDate))
            $this->channel .= $this->channel_pubDate;
        if (isset($this->channel_lastBuildDate))
            $this->channel .= $this->channel_lastBuildDate;
        if (isset($this->channel_category))
            $this->channel .= $this->channel_category;
        if (isset($this->channel_docs))
            $this->channel .= $this->channel_docs;
        if (isset($this->channel_cloud))
            $this->channel .= $this->channel_cloud;
        if (isset($this->channel_ttl))
            $this->channel .= $this->channel_ttl;
        if (isset($this->channel_image))
            $this->channel .= $this->channel_image;
        $this->channel .= $this->items;
        $this->channel .= "</rss>\r\n";
    }
}