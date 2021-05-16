$('body').on('keyup', '#brand', function () {
    $brand = $(this).val();
    $.ajax({
        type: 'GET',
        url: '/searchbrand',
        dataType: 'json',
        cache: 'false',
        data: {
            'brand': $brand,
        }, success: function (data) {
            $('.search_brand').html(data.html);

        }
    });
});

