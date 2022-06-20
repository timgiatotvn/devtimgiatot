<?php

namespace Modules\Clients\Http\Controllers;

use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientArticleService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Post;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\View;
use LukeSnowden\GoogleShoppingFeed\Containers\GoogleShopping;

class ProductsController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientArticleService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientArticleService $clientArticleService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientArticleService = $clientArticleService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', [
            'logo' => $this->clientAdvService->findByLogo(),
            'setting' => $this->setting,
            'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]),
            'top_products' => $this->clientProductService->getListHome(['limit' => 8])
        ]);
    }

    /**
     * Page show
     * @method GET
     */
    public function show($slug)
    {
        try {
            $id = Helpers::renderID($slug);
            $data['detail'] = $this->clientProductService->findById($id);
            if (empty($data['detail']->id)) abort(404);
            $data['setting'] = $this->setting;

            if (empty($data['detail']->meta_des)) {
                $des = !empty($data['detail']->description) ? strip_tags($data['detail']->description) : (!empty($data['sosanh'][0]->content) ? @preg_replace('/(<[^>]+) style=".*?"/i', '$1', strip_tags($data['sosanh'][0]->content)) : $data['detail']->content);
                $data['detail']->meta_des = Helpers::shortDesc($des, 150);
            }

            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientProductService->getListRelated(['category_id' => $data['detail']->category_id]);

            return view('clients::products.show', ['data' => $data]);
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Page show
     * @method GET
     */
    public function showSosanh($slug)
    {
        try {
            $id = Helpers::renderID($slug);
            $data['detail'] = $this->clientProductService->findById($id);
            if (empty($data['detail']->id)) abort(404);
            $data['setting'] = $this->setting;
            $data['sosanh'] = $this->clientArticleService->getList(['list_id' => explode('|', $data['detail']->keyword_suggest_map_crawler), 'limit' => 15]);
            if ($data['detail']->type == "crawler") {
                if (empty($data['detail']->title_seo)) $data['detail']->title_seo = "Giá bán " . $data['detail']->title . " tốt nhất tháng " . date("m/Y", strtotime($data['detail']->updated_at));
                if (empty($data['detail']->meta_des)) {
                    $des = !empty($data['detail']->description) ? strip_tags($data['detail']->description) : (!empty($data['sosanh'][0]->content) ? @preg_replace('/(<[^>]+) style=".*?"/i', '$1', strip_tags($data['sosanh'][0]->content)) : $data['detail']->content);
                    $data['detail']->meta_des = Helpers::shortDesc($des, 150);
                }
            }
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];

            //$data['related'] = $this->clientProductService->getListRelated(['category_id' => $data['detail']->category_id]);

            return view('clients::products.showSosanh', ['data' => $data]);
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Page feed
     * @method GET
     */
    public function feed()
    {
        try {
            $data['list'] = $this->clientProductService->getListAll(["limit" => 200]);

            GoogleShopping::title('Product Feed');
            GoogleShopping::link(asset('/'));
            GoogleShopping::description('Google Shopping Feed');

            foreach ($data['list'] as $row) {

                $item = GoogleShopping::createItem();
                $item->id($row->id);
                $item->title($row->title);
                if (!empty($row->price_root)) {
                    $item->price($row->price_root);
                    $item->sale_price($row->price);
                } else {
                    $item->price($row->price);
                }

                $item->description((strlen($row->description < 10) ? substr(strip_tags($row->content), 0, 200) : strip_tags($row->description)));
                $item->link(route('client.product.show', ['slug' => $row->slug . '-' . $row->id]));
                $item->image_link(\App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product'));
//                $item->content($row->content);
                //$item->mpn($SKU);
//                $item->sale_price($salePrice);
//                $item->link($link);
//                $item->image_link($imageLink);
//                ...
//                ...F

                /** create a variant */
//                $variant = $item->variant();
//                $variant->size($variant::LARGE);
//                $variant->color('Red');

                /**
                 * One thing to note, if creating variants, delete the initial object after you've done,
                 * Google no longer needs it!
                 *
                 * $item->delete();
                 *
                 */

            }

// boolean value indicates output to browser
            GoogleShopping::asRss(true);

        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }
}
