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

    public static function getMenuTop($limit){
        $list = Category::listCategory($limit);
        return $list;
    }

    public static function getSubMenuTop($limit,$parent){
        $list = Category::listSubCategory($limit,$parent);
        return $list;
    }

    public static function getSetting($id){
        $list = Setting::getbyID($id);
        return $list;
    }


    public static function getPostByCate($limit,$cate,$sort){
        $list = Post::getListPost($limit,$cate,$sort);
        return $list;
    }

    public static function getCate($limit,$fields,$sort){
        $list = Category::listCate($limit,$fields,$sort);
        return $list;
    }

    public static function getPostHome($limit,$fields,$sort){
        $list = Post::listPostHome($limit,$fields,$sort);
        return $list;
    }




    public static function formatDate($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('d/m/Y H:i', (strtotime($date) + $plusTime));
        } else {
            return date('d/m/Y H:i', (strtotime($date) + $plusTime));
        }
    }

    // Manh Hiep
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

    public static function getUserID($guard)
    {
        return Auth::guard($guard)->id();
    }

    public static function getDataUser($guard)
    {
        return Auth::guard($guard)->user();
    }

    public static function getUserEmail($guard)
    {
        return Auth::guard($guard)->user()->email;
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
            'title_seo' => !empty($data['title_seo']) ? $data['title_seo'] : (!empty($data['title']) ? $data['title'] : ''),
            'meta_key' => !empty($data['meta_key']) ? $data['meta_key'] : '',
            'meta_des' => !empty($data['meta_des']) ? $data['meta_des'] : ''
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

    public static function getIdFromSlug($slug)
    {
        if (empty($slug)) return '';
        $ex = explode('-', $slug);
        return $ex[(count($ex) - 1)];
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

}
