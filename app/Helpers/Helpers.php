<?php
/**
 * Created by cuongnd
 */

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;
use App\Model\Post;
use App\Model\Setting;

class Helpers
{
    public static function pre($data = array())
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public static function formatTime($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('d/m/Y', (strtotime($date) + $plusTime));
        } else {
            return date('d/m/Y', (strtotime($date) + $plusTime));
        }
    }

    public static function formatPrice($price)
    {

        $price = preg_replace("/[^0-9\s]/", "", $price);
        $number = explode(".", (string)$price);

        if (count($number) == 1) {
            return ($price > 999) ? str_replace(',', '.', number_format($price)) : $price;
        } else {
            return $price;
        }
    }

    public static function titleAction($data)
    {
        return array(
            'title' => !empty($data[0]) ? $data[0] : '',
            'flag' => !empty($data[1]) ? $data[1] : '',
        );
    }

    public static function metaHead($data)
    {
        return array(
            'title_seo' => !empty($data->title_seo) ? $data->title_seo : (!empty($data->title) ? $data->title : ''),
            'meta_key' => !empty($data->meta_key) ? $data->meta_key : '',
            'meta_des' => !empty($data->meta_des) ? $data->meta_des : ''
        );
    }

    public static function renderGuard($key = 0)
    {
        $arr = ['admins'];
        return $arr[$key];
    }

    public static function renderSTT($key, $data)
    {
        $start = ($data->currentPage() - 1) * $data->perPage();
        return $start + $key;
    }

    public static function renderStatus($status = 1)
    {
        $arr = [__('admins::layer.status.no_active'), __('admins::layer.status.active')];
        return !empty($arr[$status]) ? $arr[$status] : 'Empty';
    }

    public static function renderLinkPost($post)
    {
        return route('post.show', ['slug' => $post['link'] . '-' . $post['id']]);
    }

    public static function getTimeToText($createTime, $date_get)
    {
        $createTime = $date_get == "true" ? strtotime($createTime) : $createTime;
        $timeNow = strtotime(date('d-m-Y H:i:s'));
        $timeStatic = (($timeNow - $createTime) / (60));
        $title = '';
        //return date('d-m-Y H:i:s', $timeNow).'-'.date('d-m-Y H:i:s', $createTime).'-'.$timeStatic;
        $timeRound = ceil($timeStatic);
        $timeRoundH = $timeRound / (24 * 60);
        //return $timeRound.'-'.$timeRoundH;
        if ($timeRoundH >= 1) {
            if (round($timeRoundH) >= 30) {
                $ttday = round(round($timeRoundH) / 30);
                if ($ttday >= 12) {
                    $title = round($ttday / 12) . ' năm trước';
                } else {
                    $title = $ttday . ' tháng trước';
                }
            } else {
                $title = ceil($timeRoundH) . ' ngày trước';
            }
        } elseif (($timeRound / 60) >= 1) {
            if (round($timeRound / 60) == 24) {
                $title = '1 ngày trước';
            } else {
                $title = ceil($timeRound / 60) . ' tiếng trước';
            }
        } else {
            if ($timeStatic < 1) $title = 'Mới đăng'; else $title = ceil($timeRound) . ' phút trước';
        }
        return $title;
    }

    public static function strpos_arr($haystack, $needle)
    {
        if (!is_array($needle)) $needle = array($needle);
        foreach ($needle as $what) {
            if (($pos = strpos($haystack, $what)) !== false) return $pos;
        }
        return false;
    }

    public static function renCode($code = '')
    {
        $code = substr(md5($code), 0, 22);
        $code = substr(base64_encode($code), 0, -2);
        return $code;
    }

    public static function renderThumb($url = '', $type = '')
    {
        if (empty($url) || empty($type)) return '1';

        $str = '';
        switch ($type) {
            case 'slide':
                $str .= 'w1200/h438/fill!';
                break;
            case 'logo':
                $str .= 'w235/h53/fill!';
                break;
            case 'link':
                $str .= 'w78/fill!';
                break;
            case 'list_product':
                $str .= 'w300/h300/fill!';
                break;
            case 'list_new':
                $str .= 'w381/h200/fill!';
                break;
            case 'ads_home':
                $str .= 'w600/h210/fill!';
                break;
            case '':
                echo "";
                break;
        }
        return asset(str_replace('storage/', 'img/' . $str, $url));
    }

    public static function shortDesc($str, $len, $charset = 'UTF-8')
    {
        $str = strip_tags($str);
        $str = html_entity_decode($str, ENT_QUOTES, $charset);
        if (mb_strlen($str, $charset) > $len) {
            $arr = explode(' ', $str);
            $str = mb_substr($str, 0, $len, $charset);
            $arrRes = explode(' ', $str);
            $last = $arr[count($arrRes) - 1];
            unset($arr);
            if (strcasecmp($arrRes[count($arrRes) - 1], $last)) {
                unset($arrRes[count($arrRes) - 1]);
            }
            return implode(' ', $arrRes) . "...";
        }
        return $str;
    }

    public static function renderID($slug = '')
    {
        $arr = explode('-', $slug);
        return !empty($arr[count($arr) - 1]) ? $arr[count($arr) - 1] : '';
    }

}
