<?php

namespace App\Service\IA;

use App\Helpers\Helpers;
use App\Repository\IA\IA\IARepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IAFunction
{

    private $repository;

    public function __construct(IARepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function renderXML()
    {
        $params = [
            'limit' => 10
        ];
        $data = $this->repository->getList($params);
        $data = (count($data) > 0) ? $data->toArray() : [];

        //set XML
        $today = date("Y-m-d H:i:s");
        $domain = 'https://showbiznew.com/';

        $strxml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

        $strxml .= "<rss version=\"2.0\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\">\n";
        $strxml .= "<channel>\n";
        $strxml .= "<title>Showbiz new</title>\n";
        $strxml .= "<link>" . $domain . "</link>\n";
        $strxml .= "<description>\n";
        $strxml .= "Updating....\n";
        $strxml .= "</description>\n";
        $strxml .= "<language>vi</language>\n";
        $strxml .= "<lastBuildDate>$today</lastBuildDate>\n";

        //content data
        $strxml .= $this->returnDataXmlItemShowbiz($data, $domain);

        $strxml .= "</channel>\n";
        $strxml .= "</rss>";

        //return string data
        file_put_contents(public_path() . "/posts/list.xml", $strxml);
    }

    function returnDataXmlItemShowbiz($data = array(), $domain = '')
    {
        if (!empty($data)) {
            $strxml = '';
            $dem = 0;
            foreach ($data as $row) {
                //for ($i = 0; $i < 2; $i++) {
                //if ($row['id'] == 2326) {

                /**info**/
                $id = $row->id;
                $name = $row->title;
                $title = str_replace('★', '', $name);
                $title = str_replace('★', '', $name);
                $title = str_replace('', '', $name);
                $title = str_replace('', '', $title);
                $title = str_replace('', '', $title);
                $title = htmlspecialchars($title);
                //$title = $this->replace_str($title);
                //$title = urlencode($title);
                $link = $domain . $row->slug . '.html';
                $thumbnail_url = $domain . str_replace('/storage', 'storage', $row->thumbnail);

                /**date**/
                $date_pub = date('Y-m-d H:i:s', (strtotime($row->created_at) - (12 * 60 * 60)));
                //$date_now = date("Y-m-d H:i:s");
                //$date_modify = $date_now;
                //$date_modify = date('Y-m-d H:i:s', strtotime($date_modify));
                $date_modify = date('Y-m-d H:i:s', (strtotime($row->updated_at) - (7 * 60 * 60)));

                /**category**/
                $cate_name = $row->cate_title;

                /**author**/
                $creator = 'Say nắng';

                /**description**/
                $sapo = $row->description;
                $sapo = str_replace('', '', $sapo);
                $sapo = str_replace('', '', $sapo);
                $sapo = str_replace('★', '', $sapo);
                $sapo = str_replace('★', '', $sapo);
                $sapo = str_replace('', '', $sapo);

                /**content**/
                $content = $row->content;
//                for ($i = 0; $i < 30; $i ++) {
//                    $content = str_replace('<p><strong>', '<p>', $content);
//                    $content = str_replace('</strong></p>', '</p>', $content);
//                }

                $content = str_replace('', '', $content);
                $content = str_replace('', '', $content);
                $content = str_replace('★', '', $content);
                $content = str_replace('★', '', $content);
                $content = str_replace('', '', $content);
                $content = str_replace('<p style="text-align: center;"></p>', '', $content);
                $content = str_replace('&nbsp;', ' ', $content);
                //$content = strip_tags($content, '<p><figcaption><figure><strong><img><i><a><em><iframe>');
                //$content = strip_tags($content, '<ul></ul>');
                $content = str_replace('<ul>', '', $content);
                $content = str_replace('</ul>', '', $content);
                $content = str_replace('<ol>', '', $content);
                $content = str_replace('</ol>', '', $content);
                $content = str_replace('<li>', '<p>', $content);
                $content = str_replace('</li>', '</p>', $content);

                $content = str_replace('<p style="text-align: center;"></p>', '', $content);

                //$content =preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $content);
                $content = preg_replace("/<(p|br|div)[^>]*?(\/?)>/i", '<$1>', $content);
                $content = preg_replace("/<(br)>/", '<$1>', $content);
                $content = str_replace('<p></p>', '', $content);
                $content = str_replace('<p><p>', '', $content);
                $content = str_replace('</p></p>', '', $content);
                $content = str_replace('<div>', '<p>', $content);
                $content = str_replace('</div>', '</p>', $content);
                $content = str_replace('<h3>', '', $content);
                $content = str_replace('</h3>', '', $content);
                $content = str_replace('<br>', '', $content);
                $content = str_replace('</iframe></figure>', '</iframe>', $content);

                //repalace content
                $pattern_img = <<<'regex'
/<p><strong><img .*?><\/strong><\/p>/
regex;
                $content = $this->replaceTagHtml($pattern_img, $content);

                $pattern_img = <<<'regex'
/<p.*?>.*?<img .*? src=(["'])(.*?)\1 .*?>((\r|\n).*|.*)<\/p>/
regex;

                /*$pattern_img = "/<p>.*?<img .*? src=(.*?) .*?>(.*?)<\/p>/i";*/
                //$content = $this->changeimg($pattern_img, $content);
                //truong hop 2 ko co the p chi co the a
                $pattern_img = <<<'regex'
/<a.*?>.*?<img .*? src=(["'])(.*?)\1 .*?>((\r|\n).*|.*)<\/a>/
regex;
                $content = $this->changeimg($pattern_img, $content);
                //truong hop 3 ko co the p,a chi co the img
                $pattern_img = <<<'regex'
/<img .*? src=(["'])(.*?)\1 .*?>((\r|\n).*|.*)/
regex;
                //$content = $this->changeimg($pattern_img, $content);

                $content = str_replace('<p></p>', '', $content);
                $content = str_replace('<p>[shortcode-video', '[shortcode-video', $content);
                $content = str_replace(']</p>', ']', $content);

                //$pattern = "/\[shortcode-video.*img.*=.*[\"|\'](.*)[\"|\'].*url=.*[\"|\'](.*)[\"|\'].*\]/";
                $pattern = <<<'regex'
/\[shortcode-video[^\[\]]+url=(["']|&quot;|&#39;)([^\s]+)\1[^\[\]]*\]/
regex;
                //$content = $this->contentVideoIframe($pattern, $content);
                $content_shortcode = $content;
                $content_header = $this->format_shortcode_video_header($content_shortcode);
                //print_r($content_header); die;
                //$content = $this->format_shortcode_video($content);
                $content = $this->format_shortcode_video_hoanghn($content, $link);
                $content = $this->contentVideoIframe3($content);

                //print_r($content); die;
                //$content = $this->contentVideoIframe($pattern, $content, $link);

                $content = str_replace('<p></p>', '', $content);
                //$content = str_replace('<p><figure', '<figure', $content);
                //$content = str_replace('</figure><br></p>', '</figure>', $content);
                $content = preg_replace('/([\s\n])[\s\n]+/', '', $content);
                $content = preg_replace('/<(p)>\s+<\/\1>/', '', $content);
                $content = str_replace('<p><p>', '', $content);
                $content = str_replace('</p></p>', '', $content);
                $content = str_replace('<p></p>', '', $content);
                $content = str_replace('<p> </p>', '', $content);
                $content = str_replace('<p> </p>', '', $content);
                $content = str_replace('<p> </p>', '', $content);
                $content = str_replace('<p> </p>', '', $content);
                $content = str_replace('<p><p>', '<p>', $content);
                $content = str_replace('<p>&nbsp;</p>', '', $content);
                $content = str_replace('<p><figure', '<figure', $content);
                $content = str_replace('</figure><br></p>', '</figure>', $content);
                $content = str_replace('</figure></p>', '</figure>', $content);
                $content = str_replace('<p><iframe', '<figure class="op-interactive"><iframe', $content);
                $content = str_replace('</iframe></p>', '</iframe></figure>', $content);

                //$content = $this->repalace_figure($content);

                $content = $this->repalace_oembed($content);

                $content = preg_replace('/([\s\n])[\s\n]+/', '', $content);
                $content = preg_replace('/<(p)>\s+<\/\1>/', '', $content);

                //chen quang cao
                /*$pattern = <<<'regex'
/<([p|figure]+)[^>]*>(\s*.*\s*)<\/\1>/
regex;
                $content = $this->chenAds($pattern, $content);*/
                $content = str_replace('', '', $content);
                $content = str_replace('<center>', '', $content);
                $content = str_replace('</center>', '', $content);

                $content = $this->replaceTagHtml2($content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);
                $content = str_replace('src="/storage/', 'src="' . $domain . 'storage/', $content);

                $strxml .= "<item>\n";
//                $strxml .= " 	<title><![CDATA[" . $title . "]]></title>\n";
                $strxml .= " 	<title>$title</title>\n";
                $strxml .= " 	<link>".$link."</link>\n";
                $strxml .= "	<content:encoded>\n";
                $strxml .= "		<![CDATA[ \n";
                $strxml .= "		<!doctype html>\n";
                $strxml .= "		<html lang=\"vi\" prefix=\"op: http://media.facebook.com/op#\">\n";
                $strxml .= "		<head>\n";
                $strxml .= "		<meta charset=\"utf-8\">\n";
                //$strxml .= "		<meta property=\"fb:op-recirculation-ads\" content=\"placement_id=296203287529923_296203650863220\">\n";
                $strxml .= "		<link rel=\"canonical\" href=\"$link\">\n";
                $strxml .= "		<meta property=\"op:markup_version\" content=\"v1.0\">\n";
                $strxml .= "		<meta property=\"fb:article_style\" content=\"default\">\n";
                //$strxml .= "		<meta property=\"fb:pages\" content=\"38204370884424\" />\n";
                //$strxml .= "		<meta property=\"fb:use_automatic_ad_placement\" content=\"false\">\n";
                //$strxml .= "		<meta property=\"fb:comments\" content=\"disable\">\n";
                $strxml .= "		</head>\n";
                $strxml .= "		<body>\n";
                $strxml .= "	<article>\n";
                $strxml .= "      <header>\n";

//                $video_thump = $row['mp4'];
//                if (!empty($video_thump)) {
//                    $strxml .= "        <figure>\n";
//                    $strxml .= "<video>";
//                    $strxml .= "<source src='" . $video_thump . "' type=\"video/mp4\" />";
//                    $strxml .= "</video>";
//                    $strxml .= "        </figure>\n";
//                } else {
//                    if (!empty($content_header[0]['video'])) {
//                        $strxml .= "        <figure>\n";
//                        $strxml .= "<video>";
//                        $strxml .= "<source src='" . $content_header[0]['video'] . "' type=\"video/mp4\" />";
//                        $strxml .= "</video>";
//                        $strxml .= "        </figure>\n";
//                    } else {
//                        $strxml .= "        <figure>\n";
//                        $strxml .= "          <img src='" . $thumbnail_url . "'>\n";
//                        $strxml .= "        </figure>\n";
//                    }
//                }
                $strxml .= "        <figure>\n";
                $strxml .= "          <img src='" . $thumbnail_url . "'>\n";
                $strxml .= "        </figure>\n";

                if (!empty($title)) {
                    $strxml .= "<h1>".$title."</h1>\n";
                }
                $strxml .= "        <time class=\"op-published\" datetime=\"$date_pub\">" . date('F j, Y, g:i a', strtotime($date_pub)) . "</time>\n";
                $strxml .= "        <time class=\"op-modified\" dateTime=\"$date_modify\">" . date('F j, Y, g:i a', strtotime($date_modify)) . "</time>\n";
                if (!empty($sapo)) {
                    $strxml .= "        <h2>" . $sapo . "</h2>\n";
                }
                if (!empty($cate_name)) {
                    $strxml .= "        <h3 class=\"op-kicker\">" . $cate_name . "</h3>\n";
                }

                if (!empty($creator)) {
                    $strxml .= "<address>" . $creator . "</address>\n";
                }

                //add quảng cáo tự động vào các phần tử, check nếu bài được add thêm 1 số link tăng nội dung bài
                //$strxml .= ads_auto_template();
                //$strxml .= $output_id_fb_7;
                $strxml .= "      </header>\n";
                //$strxml .= $str_tinlq;//show tin lien quan text
                //$strxml .= $this->exportReleaseRestaurant($id);
                //$strxml .= $congthuc;
                $strxml .= $content;

//                $strxml .= "		<figure class=\"op-tracker\">\n";
//                $strxml .= "			 <iframe>\n";
//                $strxml .= "	<script type=\"text/javascript\">";
//                $strxml .= "		var _gaq = _gaq || [];";
//                $strxml .= "		_gaq.push(['_setAccount', 'UA-125628079-3']);";
//                $strxml .= "		_gaq.push(['_trackPageview']);";
//                $strxml .= "		_gaq.push(['b_setAccount', 'UA-79646628-20']);";
//                $strxml .= "		_gaq.push(['b_trackPageview']);";
//
//                $strxml .= "		(function() {";
//                $strxml .= "		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'; ";
//                $strxml .= "		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
//                $strxml .= "		})();";
//                $strxml .= "	</script>";
//                $strxml .= "			</iframe>\n";
//                $strxml .= "		</figure>\n";

                /*$strxml .= "<figure class=\"op-interactive\"><iframe width=\"320\" height=\"1030\" style=\"border:0; margin:0;\" src=\"http://api.blogtamsu.vn/blog_tinlienquan.html\"></iframe></figure>";
                $strxml .= '.';
                $strxml .= "		<figure class=\"op-tracker\">\n";
                $strxml .= "			 <iframe>\n";
                $strxml .= "	<script type=\"text/javascript\">";
                $strxml .= "		var _gaq = _gaq || [];";
                $strxml .= "		_gaq.push(['_setAccount', 'UA-107993014-1']);";
                $strxml .= "		_gaq.push(['_trackPageview']);";
                $strxml .= "		_gaq.push(['b._setAccount', 'UA-107993014-2']);";
                $strxml .= "		_gaq.push(['b._trackPageview']);";

                $strxml .= "		(function() {";
                $strxml .= "		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'; ";
                $strxml .= "		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
                $strxml .= "		})();";
                $strxml .= "	</script>";
                $strxml .= "			</iframe>\n";
                $strxml .= "		</figure>\n";*/

//                if (strpos($domain, 'blogtamsu')) {
//                    $strxml .= "		<figure class=\"op-tracker\">\n";
//                    $strxml .= "			 <iframe>\n";
//                    $strxml .= "	<script type=\"text/javascript\">";
//                    $strxml .= "		var _gaq = _gaq || [];";
//                    $strxml .= "		_gaq.push(['_setAccount', 'UA-116460844-11']);";
//                    $strxml .= "		_gaq.push(['_trackPageview']);";
//
//                    $strxml .= "		(function() {";
//                    $strxml .= "		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'; ";
//                    $strxml .= "		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
//                    $strxml .= "		})();";
//                    $strxml .= "	</script>";
//                    $strxml .= "			</iframe>\n";
//                    $strxml .= "		</figure>\n";
//                }
//
//                if (strpos($domain, 'feedy')) {
//                    $strxml .= "		<figure class=\"op-tracker\">\n";
//                    $strxml .= "			 <iframe>\n";
//                    $strxml .= "	<script type=\"text/javascript\">";
//                    $strxml .= "		var _gaq = _gaq || [];";
//                    $strxml .= "		_gaq.push(['_setAccount', 'UA-79646628-1']);";
//                    $strxml .= "		_gaq.push(['_trackPageview']);";
//                    $strxml .= "		_gaq.push(['b._setAccount', 'UA-79646628-4']);";
//                    $strxml .= "		_gaq.push(['b._trackPageview']);";
//
//                    $strxml .= "		(function() {";
//                    $strxml .= "		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js'; ";
//                    $strxml .= "		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
//                    $strxml .= "		})();";
//                    $strxml .= "	</script>";
//                    $strxml .= "			</iframe>\n";
//                    $strxml .= "		</figure>\n";
//                }

                $strxml .= "    </article>\n";
                $strxml .= "		</body>\n";
                $strxml .= "		</html>\n";
                $strxml .= "		]]>\n";
                $strxml .= "</content:encoded>\n";
                $strxml .= "	<guid isPermaLink=\"false\">" . $link . "</guid>\n";
                if (!empty($sapo)) {
                    $strxml .= "	<description><![CDATA[" . $sapo . "]]></description>\n";
                }
                $strxml .= "	<pubDate>$date_pub</pubDate>\n";
                $strxml .= "	<modDate>$date_modify</modDate>\n";
                if (!empty($creator)) {
                    //$strxml .= "	<author>" . $creator . "</author>\n";
                }
                $strxml .= "</item>\n";
                //}
                $dem++;
                //}
            }
            //}
            return $strxml;
        }
        return array();
    }

    function replaceTagHtml($pattern_img, $content)
    {
        preg_match_all($pattern_img, $content, $matches_img);

        $pattern_img = <<<'regex'
/<img .*?>/
regex;

        foreach ($matches_img[0] as $row) {
            preg_match_all($pattern_img, $row, $matches_tagimg);

            if (!empty($matches_tagimg[0][0])) {
//                $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                $figure_image = '<figure>';
                $figure_image .= $matches_tagimg[0][0];
                $figure_image .= "</figure><br>";
                $content = str_replace($row, $figure_image, $content);
            }
        }

        $pattern_img = <<<'regex'
/<p><img .*?><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        $pattern_img = <<<'regex'
/<img .*?>/
regex;

        foreach ($matches_img[0] as $row) {
            preg_match_all($pattern_img, $row, $matches_tagimg);

            if (!empty($matches_tagimg[0][0])) {
//                $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                $figure_image = '<figure>';
                $figure_image .= $matches_tagimg[0][0];
                $figure_image .= "</figure><br>";
                $content = str_replace($row, $figure_image, $content);
            }
        }

        $pattern_img = <<<'regex'
/<p><em><img .*?><\/em><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        $pattern_img = <<<'regex'
/<img .*?>/
regex;

        foreach ($matches_img[0] as $row) {
            preg_match_all($pattern_img, $row, $matches_tagimg);

            if (!empty($matches_tagimg[0][0])) {
//                $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                $figure_image = '<figure>';
                $figure_image .= $matches_tagimg[0][0];
                $figure_image .= "</figure><br>";
                $content = str_replace($row, $figure_image, $content);
            }
        }

        $pattern_img = <<<'regex'
/<(p)>\s+<\/\1>/
regex;
        $content = str_replace('<p> </p>', '', $content);
        preg_match_all($pattern_img, $content, $matches_p);

        foreach ($matches_p[0] as $row) {
            $content = str_replace($row, '', $content);
        }

        /*$pattern_img = <<<'regex'
/<iframe.*><\/iframe>/
regex;
        $content = str_replace('<p> </p>', '', $content);
        preg_match_all($pattern_img, $content, $matches_p);


        foreach ($matches_p[0] as $row) {
            $content = str_replace($row, '<figure class="op-interactive">' . $row . '</figure>', $content);
        }
        */

        /*$pattern_img = <<<'regex'
/<iframe.*><\/iframe>/
regex;
        $content = str_replace('<p> </p>', '', $content);
        preg_match_all($pattern_img, $content, $matches_p);


        foreach ($matches_p[0] as $row) {
            $content = str_replace($row, '<figure class="op-interactive">' . $row . '</figure>', $content);
        }
        */

        $pattern = <<<'regex'
/<ul.*?>/
regex;
        preg_match_all($pattern, $content, $matches_p);

        foreach ($matches_p[0] as $row) {
            $content = str_replace($row, '', $content);
        }


        $pattern_img = <<<'regex'
/<p><strong> <img .*?><\/strong><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);
        $pattern_img = <<<'regex'
/<img .*?>/
regex;
        foreach ($matches_img[0] as $row) {
            preg_match_all($pattern_img, $row, $matches_tagimg);

            if (!empty($matches_tagimg[0][0])) {
//                $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                $figure_image = '<figure>';
                $figure_image .= $matches_tagimg[0][0];
                $figure_image .= "</figure><br>";
                $content = str_replace($row, $figure_image, $content);
            }
        }

        $pattern_img = <<<'regex'
/<p> <strong><img .*?><\/strong><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);
        $pattern_img = <<<'regex'
/<img .*?>/
regex;
        foreach ($matches_img[0] as $row) {
            preg_match_all($pattern_img, $row, $matches_tagimg);

            if (!empty($matches_tagimg[0][0])) {
//                $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                $figure_image = '<figure>';
                $figure_image .= $matches_tagimg[0][0];
                $figure_image .= "</figure><br>";
                $content = str_replace($row, $figure_image, $content);
            }
        }

        $pattern_img = <<<'regex'
/<p.*?>(.*?)<\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        $pattern_img = <<<'regex'
/<img .*?>/
regex;
        foreach ($matches_img[0] as $row) {
            if (strpos($row, 'img')) {
                preg_match_all($pattern_img, $row, $matches_tagimg);

                if (!empty($matches_tagimg[0][0])) {
//                    $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                    $figure_image = '<figure>';
                    $figure_image .= $matches_tagimg[0][0];
                    $figure_image .= "</figure><br>";
                    $content = str_replace($row, $figure_image, $content);
                }
            }
        }

        //$content = preg_replace('/<\s*p[^>]*>([^<]*)<\s*\/\s*p\s*>/i', '', $content);
        $content = preg_replace("/<li.*?>/", '<p>', $content);


        $pattern_img = <<<'regex'
/<center><img .*?><\/center>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        $pattern_img = <<<'regex'
/<img .*?>/
regex;
        foreach ($matches_img[0] as $row) {
            if (strpos($row, 'img')) {
                preg_match_all($pattern_img, $row, $matches_tagimg);

                if (!empty($matches_tagimg[0][0])) {
//                    $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                    $figure_image = '<figure>';
                    $figure_image .= $matches_tagimg[0][0];
                    $figure_image .= "</figure><br>";
                    $content = str_replace($row, $figure_image, $content);
                }
            }
        }

        //$content = preg_replace('/<\s*p[^>]*>([^<]*)<\s*\/\s*p\s*>/i', '', $content);
        $content = preg_replace("/<li.*?>/", '<p>', $content);

        return $content;
    }

    function format_shortcode_video_header($content)
    {
        $content = str_replace('<p></p>', '', $content);
        $content = str_replace('<p>[shortcode-video', '[shortcode-video', $content);
        $content = str_replace(']</p>', ']', $content);
        $pattern = <<<'regex'
/\[shortcode-video (.*?)\]/
regex;

        preg_match_all($pattern, $content, $matches);

        $c_matches = $matches[0];
        $d_matches = $matches[1];
        $arr_video = array();

        $listVideo = array();
        try {
            if (!empty($d_matches)) {
                foreach ($d_matches as $key => $item) {
                    $value = explode(" ", str_replace("&#39;", "'", $item));
                    $itemvideo = [];
                    foreach ($value as $d) {
                        if (!empty(explode("=", $d, 2)) && count(explode("=", $d, 2)) > 1) {
                            list($opt, $val) = explode("=", $d, 2);
                            $itemvideo[$opt] = trim($val, "'");
                        }
                    }
                    $listVideo[$key] = $itemvideo;
                }

                foreach ($listVideo as $key => $item) {
                    $videoid = !empty($item['id']) ? $item['id'] : null;
                    $poster = !empty($item['img']) ? $item['img'] : null;
                    $url = !empty($item['url']) ? $item['url'] : null;
                    $path = !empty($item['path']) ? $item['path'] : null;
                    $type = !empty($item['type']) ? $item['type'] : 0;
                    $video_html = '';

                    if ($type == 1) {

                    } else {
                        $arr_video[] = array(
                            'video' => $path,
                            'img' => $poster
                        );
                    }

                    $content = $arr_video;

                }
            }

            return $content;

        } catch (\Exception $exception) {

        }

        return $content;
    }

    function format_shortcode_video_hoanghn($content, $url_domain = '')
    {

        $content = str_replace('<p></p>', '', $content);
        $content = str_replace('<p>[shortcode-video', '[shortcode-video', $content);
        $content = str_replace(']</p>', ']', $content);
        $pattern = <<<'regex'
/\[shortcode-video (.*?)\]/
regex;

        preg_match_all($pattern, $content, $matches);

        $c_matches = $matches[0];
        $d_matches = $matches[1];

        $listVideo = array();
        try {
            if (!empty($d_matches)) {
                foreach ($d_matches as $key => $item) {
                    $value = explode(" ", str_replace("&#39;", "'", $item));
                    $itemvideo = [];
                    foreach ($value as $d) {
                        if (!empty(explode("=", $d, 2)) && count(explode("=", $d, 2)) > 1) {
                            list($opt, $val) = explode("=", $d, 2);
                            $itemvideo[$opt] = trim($val, "'");
                        }
                    }
                    $listVideo[$key] = $itemvideo;
                }

                foreach ($listVideo as $key => $item) {
                    $videoid = !empty($item['id']) ? $item['id'] : null;
                    $poster = !empty($item['img']) ? $item['img'] : null;
                    $url = !empty($item['url']) ? $item['url'] : null;
                    $path = !empty($item['path']) ? $item['path'] : null;
                    $type = !empty($item['type']) ? $item['type'] : 0;
                    $video_html = '';

                    if ($type == 1) {
                        $link_video = str_replace('watch?v=', 'embed/', $path);
                        $video_html .= '<figure class="op-interactive">';
                        $video_html .= "<iframe id=\"$id\" frameborder=\"0\" allowfullscreen width=\"300\" height=\"180\" style=\"border:0; margin:0;\" src=\"$path\" ></iframe>";
                        $video_html .= '</figure>';
                    } else {
                        $video_html .= '<figure class="op-interactive">';
                        $url = 'http://m.feedy.tv/ia/iaplayer.html?url=' . $path . '&image=' . $poster . '&id=' . $videoid . '&linkweb=' . $url_domain;
                        $video_html .= "<iframe frameborder=\"0\" allowfullscreen width=\"300\" height=\"180\" style=\"border:0; margin:0;\" src=\"$url\" ></iframe>";
                        $video_html .= '</figure><br>';
                    }

//                    $content = str_replace($c_matches[$key], $video_html, $content);
                    $content = str_replace($c_matches[$key], '', $content);

                }
            }

            return $content;

        } catch (\Exception $exception) {

        }

        return $content;
    }

    function contentVideoIframe3($content_2)
    {
        //  preg_match('/src="https\:\/\/www\.youtube(.+)\"\ /', $content_2, $match);
        $pattern = "/\<iframe.*?src=[\"|\'](.*?)[\"|\'].*>.*?<\/iframe>/";
        preg_match_all($pattern, $content_2, $matches);

        foreach ($matches[0] as $key => $match) {
            if (isset($matches[1][$key])) {
                $link_video = $matches[1][$key];
            }
            if (!empty($link_video)) {
                $figure_video = "";
                $figure_video .= '<figure class="op-interactive">';
                $figure_video .= "<iframe frameborder=\"0\" allowfullscreen width=\"300\" height=\"180\" style=\"border:0; margin:0;\" src=\"$link_video\" ></iframe>";
                $figure_video .= '</figure><br>';
                $content_2 = str_replace($match, $figure_video, $content_2);
                $content_2 = preg_replace('/([\n])[\n]+/', '', $content_2);
                $content_2 = str_replace('<p><center><figure', '<figure', $content_2);
                $content_2 = str_replace('</figure><br></center></p>', '</figure><br>', $content_2);
                $content_2 = str_replace('<p><figure', '<figure', $content_2);
                $content_2 = str_replace('</figure><br></p>', '</figure><br>', $content_2);
                //Helper::pre($content_2);
            }
        }
        return $content_2;
    }

    function repalace_oembed($content)
    {
        $content_x = array();
        preg_match_all('/<oembed>.*?<\/oembed>/', $content, $content_x);

        if (!empty($content_x[0])) {
            foreach ($content_x[0] as $row) {

                //echo $row.'-';
                $row1 = str_replace('<oembed>', '', $row);
                $row1 = str_replace('</oembed>', '', $row1);
                $video_html = '<figure class="op-interactive">';
                $time = time();
                $video_html .= "<iframe id=\"$time\" frameborder=\"0\" allowfullscreen width=\"300\" height=\"180\" style=\"border:0; margin:0;\" src=\"$row1\" ></iframe>";
                $video_html .= '</figure>';

                $content = str_replace($row, $video_html, $content);
            }//die;
        }
        return $content;
    }

    function replaceTagHtml2($content)
    {
        $pattern_img = <<<'regex'
/<p><strong><fig.*><\/strong><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        $pattern_img = <<<'regex'
/<figure.class="op-interactive"><iframe.*><\/iframe><\/figure>/
regex;
        foreach ($matches_img[0] as $row) {
            if (strpos($row, '<figure class="op-interactive">')) {
                preg_match_all($pattern_img, $row, $matches_tagimg);

                if (!empty($matches_tagimg[0][0])) {
                    $content = str_replace($row, $matches_tagimg[0][0], $content);
                }
            }
        }

        $content = preg_replace("/<imgsrc/", '<img src', $content);
        $content = str_replace('<imgsrc', '<img src', $content);

        $content = preg_replace("/<(ul|ol)[^>]*?(\/?)>/i", '', $content);
        $content = preg_replace("/<(\/ul|\/ol)[^>]*?(\/?)>/i", '', $content);


        $pattern_img = <<<'regex'
/<p.*?><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        if (!empty($matches_img[0])) {
            foreach ($matches_img[0] as $row) {
                $tmp = strip_tags($row);
                if (strlen($tmp) <= 1) {
                    $content = str_replace($row, '', $content);
                }
            }
        }

        $pattern_img = <<<'regex'
/<p.*?><\/p>/
regex;
        preg_match_all($pattern_img, $content, $matches_img);

        if (!empty($matches_img[0])) {
            foreach ($matches_img[0] as $row) {
                $tmp = strip_tags($row);
                if (strlen($tmp) <= 1) {
                    $content = str_replace($row, '', $content);
                }
            }
        }

        $content = str_replace('<figure class="op-interactive"><figure class="op-interactive">', '<figure class="op-interactive">', $content);
        $content = str_replace('</figure><br></figure>', '</figure>', $content);

        return $content;
    }

    function changeimg($pattern_img, $content)
    {
        //truong hop 2 ko co the p chi co the a
        /*$pattern_img = "/<a.*?>.*?<img .*? src=(.*?) .*?>((\r|\n).*|.*)<\/a>/";*/
        preg_match_all($pattern_img, $content, $matches_img);
        $figure_image = "";
        $i = 0;
        foreach ($matches_img[0] as $key => $match_img) {
            $linkimg = $matches_img[2][$i];
            $captionimg = !empty($matches_img[3][$i]) ? $matches_img[3][$i] : '';
            /*$captionimg = preg_replace("/<a|em|p[^>]*?>|<\/a|em|p>/i", "", $captionimg);*/
            //remove hết cac thẻ tag chỉ lấy text
            $captionimg = preg_replace('/<[^>]*>/', '', $captionimg);

            $linkimg = str_replace('"', '', $linkimg);

            //check duoi anh
            $arrImg = array('jpg', 'png', 'jpeg', 'gif', 'peg', 'tiff');
            $flag = 0;
            foreach ($arrImg as $row) {
                if (strpos($linkimg, $row) > 0) $flag = 1;
                if ($flag) break;
            }

            if ($flag == 1) {
//                $figure_image = '<figure data-feedback="fb:likes,fb:comments">';
                $figure_image = '<figure>';
                $figure_image .= "<img src='" . $linkimg . "' />";
                if (!empty($captionimg)) {
                    $figure_image .= "<figcaption>$captionimg</figcaption>";
                }

                $figure_image .= "</figure><br>";
                $figure_image = str_replace('<figcaption></figcaption>', '', $figure_image);
            } else {
                $figure_image = '';
            }
            $content = str_replace($match_img, $figure_image, $content);

            $i++;
        }
        return $content;
    }

}
