<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\EmailTemplate;
use App\Service\Admins\CategoryService;
use App\Service\Admins\ProductService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Product\CreateRequest;
use Modules\Admins\Http\Requests\Product\EditRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ConfigController extends Controller
{

    private $categoryService;
    private $productService;
    private $type;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->type = [$this->categoryService::TYPE[1]];
    }

    public function configCateHome(Request $request)
    {
        try {
            $data['list_cate'] = DB::table('categories')
                ->where('parent_id', 2)
                ->get();
            $data['list_cate_show'] = DB::table('categories_show')
                ->where('status', 1)
                ->orderBy('id')
                ->get();
            return view('admins::config.homeCate', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
    public function configPostAdv(Request $request)
    {
        try {
            $data['img'] = DB::table('adv_post')
                ->where('id', 1)
                ->first();
            return view('admins::config.postAdv', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function setValue(Request $request)
    {
        try {
            $_params = $request->all();
            foreach ($_params['cate_show'] as $index => $value) {
                DB::table('categories_show')->where('id', $_params['cate_id'][$index])->update(['cate_id' => $value]);
            }
            session()->flash('success', __('Thao tác thành công'));
            return redirect()->route('admin.config.home-cate');
        } catch (\Exception $e) {
            abort('500');
        }
    }
    public function setValuePostAdv(Request $request)
    {
        try {
            $path = $request->get('thumbnail');
            $link = $request->get('link');
            $code = $request->get('google_code');
            $location_code_google = $request->get('location_code_google');
            if ($path==null){
                session()->flash('error', __('Vui lòng chọn hình ảnh cần cập nhật'));
                return redirect()->route('admin.config.post-adv');
            }
            DB::table('adv_post')->where('id', 1)->update(['path' => $path,'link'=>$link,'google_code'=>$code,'location_code_google'=>$location_code_google]);
            session()->flash('success', __('Thao tác thành công'));
            return redirect()->route('admin.config.post-adv');
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function listTemplateEmail()
    {
        $emails = EmailTemplate::latest()->get();

        return view('admins::email_templates.list', [
            'emails' => $emails
        ]);
    }

    public function viewAddTemplateEmail()
    {
        return view('admins::email_templates.add');
    }

    public function viewEditTemplateEmail($id)
    {
        $email = EmailTemplate::find($id);

        return view('admins::email_templates.edit', [
            'email' => $email
        ]);
    }

    public function storeTemplateEmail(Request $request)
    {
        EmailTemplate::updateOrCreate(
            [
                'code' => $request->code
            ],[
                'subject' => $request->subject,
                'content' => $request->content,
                'name' => TYPE_EMAIL_TEMPLATES[$request->code]
            ]
        );

        return redirect()->route('admin.config.list-template-email')->with('success', 'Thêm thành công');
    }

    public function updateTemplateEmail(Request $request, $id)
    {
        EmailTemplate::whereId($id)->update([
                'code' => $request->code,
                'subject' => $request->subject,
                'content' => $request->content,
                'name' => TYPE_EMAIL_TEMPLATES[$request->code]
        ]);

        return redirect()->route('admin.config.list-template-email')->with('success', 'Sửa thành công');
    }

    public function deleteTemplateEmail($id)
    {
        EmailTemplate::whereId($id)->delete();

        return redirect()->route('admin.config.list-template-email')->with('success', 'Xóa thành công');
    }
}
