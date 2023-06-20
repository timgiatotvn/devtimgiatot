<?php

function showCategories($categories, $parent_id = 0, $char = '', $stt = 0)
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        if ($stt == 0){
            $class_name = 'list-group list-group-flush list-category';
            $class_li = "list-group-item";
        } else if ($stt == 1){
            $class_name = 'sub-menu';
            $class_li = "";
        } else {
            $class_name = 'sub-menu';
            $class_li = "";
        }
         
        echo "<ul class='$class_name'>";
        foreach ($cate_child as $key => $item)
        {
            if ($stt == 0) {
                // Hiển thị tiêu đề chuyên mục
                echo "<li class='$class_li'>";
                echo "<div class='item-category'>
                                            <a href='$item[link]'>" . $item["name"] . '</a>
                                            <div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                        </div>';
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item['id'], $char.'|---', $stt + 1);
                echo '</li>';
            } else {
                // Hiển thị tiêu đề chuyên mục
                echo "<li class='$class_li'>";
                echo '<div class="item-category"><a href="' . $item['link'] . '" class="sub-item">' . $item['name'] . '</a></div>';
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item['id'], $char.'|---', $stt + 1);
                echo '</li>';
            }
            
        }
        echo '</ul>';
    }
}

function showCategoryMobile($categories, $parent_id = 0, $char = '', $stt = 0)
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        if ($stt == 0){
            $class_name = 'sub-menu-primary';
            $class_li = "";
        } else if ($stt == 1){
            $class_name = 'sub-sub-nav-item';
            $class_li = "";
        } else {
            $class_name = 'sub-sub-nav-item"';
            $class_li = "";
        }
         
        echo "<ul class='$class_name'>";
        foreach ($cate_child as $key => $item)
        {
            if ($stt == 0) {
                // Hiển thị tiêu đề chuyên mục
                echo "<li class='$class_li'>";
                echo '<div class="sub-nav-item">
                        ' . "<a href='$item[link]'>" . $item['name'] . '</a>
                        <div class="sub-sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                      </div>';
                
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategoryMobile($categories, $item['id'], $char.'|---', $stt + 1);
                echo '</li>';
            } else {
                // Hiển thị tiêu đề chuyên mục
                echo "<li class='$class_li'>";
                echo '<div class="sub-nav-item">' . "<a href='$item[link]'>" . $item['name'] . '</a></div>';
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategoryMobile($categories, $item['id'], $char.'|---', $stt + 1);
                echo '</li>';
            }
            
        }
        echo '</ul>';
    }
}