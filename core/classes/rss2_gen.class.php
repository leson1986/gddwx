<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: Rss2 ������
 ***********************************************************/

class Rss2Gen {

    var $rss_header;  //RSS�ĵ�ͷ�����һ��<rss>��Ԫ�ؼ���version���ԡ�
    var $item;
    var $items;
    var $channel_header; //Ƶ����ͷ����Ϣ�����Ƶ�����ơ�URL�����������ԡ���Ȩ�ȵȡ�
    //--------------- ����Ԫ���ǿ�ѡ��Ƶ����Ԫ�� --------------//
    var $channel_language; //Ƶ��ʹ�õ��������࣬����en-us��zh-cn�ȣ��ű�ۼ�����֯��һ���Ե�վ�㡣
    var $channel_copyright; //Ƶ�����ݵİ�Ȩ������
    var $channel_managingEditor; //�Ը�Ƶ�����ݸ���ĸ��˵�Email��ַ
    var $channel_webMaster;   //�Ը�Ƶ���ļ���֧�ָ���ĸ��˵�Email��ַ
    var $channel_pubDate;   //��Ƶ�����ݵĹ�������
    var $channel_lastBuildDate;  //�ϴ�Ƶ�����ݸ��ĵ�ʱ��
    var $channel_category;   //˵��Ƶ��������һ����������
    var $channel_docs;   //RSS�ļ���ʹ�ø�ʽ��˵���ĵ����ڵ�URL
    var $channel_cloud;   //�������ע��Ϊ��cloud����Ƶ������ʱ֪ͨ��
    var $channel_ttl;   //ttl ������ʱ�䣬���ʱ����һ�����֣���ʾ��Ҫ��ˢ��֮ǰ����ķ�����
    var $channel_image;   //ָ��һ������Ƶ������ʾ��GIF��JPEG ��PNG ͼ��
    var $channel;   //����rss2�ĵ���Ϣ��������������ҳ�档
    var $halt_on_error = true;
    var $encoding;

    /**
    * ���캯�����������Ϊrss2�����Ƶ����Ԫ�أ���������ΪĬ�����ݡ�
    *
    * @param String $title Ƶ�������ƣ�Ƶ����titleӦ�ú�webվ���title����һ�¡�
    * @param String $link ���Ƶ��������webվ���URL��
    * @param String $description ��Ƶ����һ�μ������������Ƶ������ʲô�ġ�
    * @access public
    */
    function Rss2Gen($encoding) {
        $this->encoding = $encoding;
        $this->fillHeader();
    }

    /**
    * ����RSS�ĵ�ͷ��������һ��<rss>Ԫ����Ϊ��Ԫ�أ�����һ��ǿ������version��ָ����ǰ�ĵ����ص�RSS�汾��
    * @access private
    */
    function fillHeader() {
        $this->rss_header = "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\r\n";
        $this->rss_header .= " <rss version=\"2.0\">\r\n";
    }

    /**
    * ����Ƶ��ͷ����������Ԫ��Ϊ����ġ�
    * @param String $title Ƶ�������ƣ�Ƶ����titleӦ�ú�Webվ���title����һ�¡�
    * @param String $link ���Ƶ��������Webվ�����վ�������URL��
    * @param String $description ��Ƶ����һ�μ���������Ҫ����Ƶ������ʲô�ġ�
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
    * ���ø�RSS�ĵ������ԣ�Ĭ��Ϊ�������ġ�
    * @access public
    */
    function setLanguage($lang = "zh_cn") {
        $this->channel_language = "  <language>".$lang."</language>\r\n";
    }

    /**
    * Ƶ�����ݵİ�Ȩ����
    * @access public
    */
    function setCopyright($copyright = "exblog") {
        $this->channel_copyright = "  <copyright>".$copyright."</copyright>\r\n";
    }

    /**
    * �Ը�Ƶ�����ݸ���ĸ��˵�Email��ַ
    * @access public
    */
    function setManagingEditor($email = NULL) {
        if (empty($email)) {
            $this->halt("����������˸�Ƶ�����ݸ���ĸ��˵�Email��ַ������д����");
        }
        $this->channel_managingEditor = "  <managingEditor>".$email."</managingEditor>\r\n";
    }

    /**
    * �Ը�Ƶ���ļ���֧�ָ���ĸ��˵�Email��ַ
    * @access public
    */
    function setWebMaster($email = NULL) {
        if (empty($email)) {
            $this->halt("����������˸�Ƶ���ļ���֧�ָ���ĸ��˵�Email��ַ������д���� :)");
        }
        $this->channel_webMaster = "  <webMaster>".$email."</webMaster>\r\n";
    }

    /**
    * ��Ƶ�����ݵĹ������ڡ�
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
    * �ϴ�Ƶ�����ݸ��ĵ�ʱ��
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
    * ˵��Ƶ��������һ����������
    * @access public
    */
    function setCategory($category) {
        $this->channel_category = "  <category>".$category."</category>\r\n";
    }

    /**
    * RSS�ļ���ʹ�ø�ʽ��˵���ĵ����ڵ�URL
    * @access public
    */
    function setDocs($url) {
        $this->channel_docs = "  <docs>".$url."</docs>\r\n";
    }

    /**
    * ttl ������ʱ�䣬���ʱ����һ�����֣���ʾ��Ҫ��ˢ��֮ǰ����ķ�����
    * @access public
    */
    function setTtl($minute) {
        $this->channel_ttl = "  <ttl>".$minute."</ttl>\r\n";
    }

    /**
    * ָ��һ������Ƶ������ʾ��GIF��JPEG ��PNG ͼ��
    *
    * @param String $url ���裬�Ǳ�ʾ��Ƶ���� GIF��JPEG �� PNG ͼ���URL
    * @param String $title ���裬��ͼ�����������Ƶ���� HTML ����ʱ������ HTML <image> ��ǩ�� ALT ���ԡ�
    * @param String $link ���裬��վ��� URL�����Ƶ���� HTML ���֣���ͼ����Ϊ�����վ������ӡ�
    * @param Integer $width ��ʾͼ������ؿ������ $height һͬ���ã����򲻻���ʾ�����ԡ�
    * @param Integer $height ��ʾͼ������ظߣ������ $width һͬ���ã����򲻻���ʾ�����ԡ�
    * @param String $description Χ���Ÿ�ͼ���γɵ�����Ԫ�ص� title ���ԡ�
    *
    * @access public
    */
    function setChannelImage($url, $title, $link, $width = NULL, $height = NULL, $description = NULL) {
        if (!isset($url))
            $this->halt("�����Ҫ����ͼƬ����ͼ���ַ���Ա�����д��");
        if (!isset($title))
            $this->halt("�����Ҫ����ͼƬ����ͼ���������Ա�����д��");
        if (!isset($link))
            $this->halt("�����Ҫ����ͼƬ����ͼ���������Ա�����д�����URLһ���ͼ���ַ������ͬ");
        $this->channel_image = "  <image>\r\n";
        $this->channel_image .= "   <url>".$url."</url>\r\n";
        $this->channel_image .= "   <title><![CDATA[".$title."]]></title>\r\n";
        $this->channel_image .= "   <link>".$link."</link>\r\n";
        //���������ͼ���������Ӵ����ԡ�
        if (!empty($width) && !empty($height)) {
            $this->channel_image .= "   <width>".$width."</width>\r\n";
            $this->channel_image .= "   <height>".$height."</height>\r\n";
        }
        if (!empty($description))
            $this->channel_image .= "   <description><![CDATA[".$description."]]></description>\r\n";
        $this->channel_image .= "</image>\r\n";
    }

    /**
    * ���һ��item��channel�У���Ȼitem����Ԫ�ض��ǿ�ѡ�ģ�������Ҫ����һ��title��description
    *
    * @param String $title �item���ı���
    * @param String $description �item���Ĵ��
    * @param String $link �item����URL
    * @param String $author �item�����ߵ�Email ��ַ
    * @param String $category �����item����һ����������
    * @param String $comments �����item����ע��ҳ��URL
    * @param String $enclosure ֧�ֺ͸��item���йص�ý�����
    * @param String $guid Ψһ����item����ϵ��һ�������������
    * @param String $pubDate ���item����ʲôʱ�򷢲���
    * @param String $Source ���item�������ĸ�RSS Ƶ���������item���ۺ���һ��ʱ�ǳ�����
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
        //�ж��Ƿ����������title��description
        if (empty($title) && empty($description)) {
            $this->halt("item:����������title��description���ԡ�");
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
    * ��� rss2 �ĵ�
    */
    function builder() {
        $this->stuff();
        header("Content-type:application/xml");
        print $this->channel;
    }

    /**
    * �����ϰ汾rss���ɷ�����ȥ����д�ļ����ܡ�
    *
    */
    function buildRssFeed($param = NULL) {
        $this->builder();
    }

    /**
    * �ϳ�����RSS2�ĵ�
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