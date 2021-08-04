$(document).ready(function(){
    
    filter_data();

    $('input[name=filter]').click(function() {
        filter_data();
    });
    $('.sort').click(function() {
        sort_data();
    });

    function sort_data() {
        var action = 'fetch_data';
        var order = $(`.sort`).data('order');
        if(order == 'desc') {
            $(`.sort`).data('order', 'asc');
            arrow = 'Cena <i class="sort fa fa-arrow-up"></i>';
        } else {
            $(`.sort`).data('order', 'desc');
            arrow = 'Cena <i class="sort fa fa-arrow-down"></i>';
        }

        $.ajax({
            url: "/includes/functions/article/view_articles.inc.php",
            method: "POST",
            data: {
                action,
                order
            },
            success: data => {
                $('.filter_data').html(data);
                $(`.sort`).html(arrow);
            }
        })
    }

    function filter_data() {
        var action = 'fetch_data';
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var categories = get_filter('categories'); 
        var manufacturers = get_filter('manufacturers');

        $.ajax({
            url: "/includes/functions/article/view_articles.inc.php",
            method: "POST",
            data: {
                action,
                min_price,
                max_price,
                categories,
                manufacturers
            },
            success: data => {
                $('.filter_data').html(data);
            }
        })
    }

    function get_filter(name) {
        var filter = [];
        $(`#${name}:checked`).each(function() {
            filter.push($(this).val());
        });

        return filter;
    }
})