<?php

namespace Modules\Admins\Http\Controllers;

use App\Model\EmailSetting;
use App\Model\Widget;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index()
    {
        $data["widgets"] = Widget::latest()->get();

        return view("admins::widgets.index", [
            "data" => $data
        ]);
    }

    public function edit($name)
    {
        $widget = Widget::where("name", $name)->first();

        return view("admins::widgets.edit", [
            "widget" => $widget
        ]);
    }
    
    public function store(Request $request, $name)
    {
        $widget = Widget::where("name", $name)->first();

        if ($widget->name == "promotion") {
            return $this->storePromotion($request->all(), $widget);
        } else if ($widget->name == "ecommerce") {
            return $this->storeEcommerce($request->all(), $widget);
        } else if ($widget->name == "footer") {
            return $this->storeFooter($request->all(), $widget);
        } else if ($widget->name == "image_coupon_partner" || $widget->name == "image_most_search") {
            return $this->storeImageCouponPartner($request->all(), $widget);
        }
    }

    // public function deleteImageCouponPartner($name, $id)
    // {
    //     $widget = Widget::where('name', $name)->first();
    //     $content = json_decode($widget->content, true);
    //     unset($content[$id]);
    //     $widget->update(["content" => json_encode($content)]);

    //     return back()->with("success", "Xóa thành công");
    // }

    public function storeImageCouponPartner($inputs, $widget)
    {
        if (is_null($widget->content)) {
            $content = [$inputs["image"]];
        } else {
            $content = json_decode($widget->content, true);
            $content[] = $inputs["image"];
        }
        $widget->update([
            "content" => json_encode($content)
        ]);

        return back()->with("success", "Thêm thành công");
    }

    public function storeFooter($inputs, $widget)
    {
        $widget->update(["content" => json_encode($inputs['block'])]);

        return back()->with("success", "Thành công");
    }

    public function delete($name, $id)
    {
        $widget = Widget::where("name", $name)->first();
        $content = json_decode($widget->content, true);
        unset($content[$id]);
        $widget->update([
            "content" => json_encode($content)
        ]);

        return back()->with("success", "Xóa thành công");
    }

    public function update(Request $request, $name)
    {
        $widget = Widget::where("name", $name)->first();

        if ($widget->name == "promotion") {
            return $this->updatePromotion($request->all(), $widget);
        } else if ($widget->name == "ecommerce") {
            return $this->updateEcommerce($request->all(), $widget);
        }
    }

    public function updateEcommerce($inputs, $widget)
    {
        $content = json_decode($widget->content, true);
        $content[$inputs["id"]] = [
            "title" => $inputs["title"],
            "description" => $inputs["description"],
            "action" => $inputs["action"],
            "date" => $inputs["date"]
        ];
        $widget->update(["content" => json_encode($content)]);

        return back()->with("success", "Sửa thành công");
    }

    public function updatePromotion($inputs, $widget)
    {
        $content = json_decode($widget->content, true);
        $content[$inputs["id"]] = [
            "title" => $inputs["title"],
            "link" => $inputs["link"]
        ];
        $widget->update(["content" => json_encode($content)]);

        return back()->with("success", "Sửa thành công");
    }

    public function storeEcommerce($inputs, $widget)
    {
        if (is_null($widget->content)) {
            $widget->update([
                "content" => json_encode([
                    [
                        "title" => $inputs["title"],
                        "description" => $inputs["description"],
                        "action" => $inputs["action"],
                        "date" => $inputs["date"]
                    ]
                ])
            ]);
        } else {
            $content = json_decode($widget->content, true);
            $content[] = [
                "title" => $inputs["title"],
                "description" => $inputs["description"],
                "action" => $inputs["action"],
                "date" => $inputs["date"]
            ];
            $widget->update(['content' => json_encode($content)]);
        }

        return back()->with("success", "Thêm thành công");
    }

    public function storePromotion($inputs, $widget)
    {
        if (is_null($widget->content)) {
            $widget->update([
                "content" => json_encode([
                    [
                        "title" => $inputs["title"],
                        "link" => $inputs["link"]
                    ]
                ])
            ]);
        } else {
            $content = json_decode($widget->content, true);
            $content[] = [
                "title" => $inputs["title"],
                "link" => $inputs["link"]
            ];
            $widget->update(['content' => json_encode($content)]);
        }

        return back()->with("success", "Thêm thành công");
    }
}