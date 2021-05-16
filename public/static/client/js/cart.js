function del_item(e, token){
    var item_id = e.getAttribute("data-id");
    $('#item'+item_id).remove();

    $.ajax({
        type : 'post',
        url : '/rmOrder',
        data: {
            "productId": item_id,
            "_token"   : token
        },
        success:function (response) {
            success_notify(response.message);
            location.reload();
        }
    })
}
function up_item(e){
    let $total_pice_cart = $('#total_pice_cart');
    var item_id = e.getAttribute("data-id");
    var item_type = e.getAttribute("data-type");
    var quantity_default = $('#quantity_'+item_id).val();
    var price = e.getAttribute("data-price");

    var total_pice_cart = $total_pice_cart.html().replace(' đ', '');

    $total_pice_cart.html(parseInt(total_pice_cart) + parseInt(price) + ' đ');
    $('#total_pice').html(parseInt(total_pice_cart) + parseInt(price) + ' đ');

    if (quantity_default >= 1) {
        var temp = ++quantity_default;
        $('#quantity_'+item_id).val(temp);
    }
}

function down_item(e){
    let $total_pice_cart = $('#total_pice_cart')
    var item_id = e.getAttribute("data-id");
    var item_type = e.getAttribute("data-type");
    var quantity_default = $('#quantity_'+item_id).val();
    var price = e.getAttribute("data-price");

    var total_pice_cart = $total_pice_cart.html().replace(' đ', '');

    if (quantity_default == 0 ) {
        $('#quantity_'+item_id).val(0);
    }
    if (quantity_default > 1) {
        var temp = --quantity_default;
        $('#quantity_'+item_id).val(temp);

        $total_pice_cart.html(parseInt(total_pice_cart) - parseInt(price) + ' đ');
        $('#total_pice').html(parseInt(total_pice_cart) - parseInt(price) + ' đ');
    }
}

function addToCart(e, productId, token)
{
    let quantity = $('.quantity_detail').val();
    $.ajax({
        type : 'post',
        url : '/order',
        data: {
            "productId": productId,
            "_token"   : token,
            "quantity"   : quantity
        },
        success:function (response) {
            if (response.code == 200) {
                success_notify(response.message);
            } else {
                errors_notify(response.message)
            }
            location.reload();
        }
    })
}
