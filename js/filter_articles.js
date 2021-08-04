$(document).ready(function(){
    // Sort data (ASC, DESC) by Price
    $('#sort_article').click(function() {
        sort_data();
    });

    function sort_data() {
        var action = 'fetch_data';
        var order = $(`#sort_article`).data('order');
        if(order == 'desc') {
            $(`#sort_article`).data('order', 'asc');
            arrow = 'Cena <small>Rastuca <i class="sort_article fa fa-arrow-up"></i></small>';
        } else {
            $(`#sort_article`).data('order', 'desc');
            arrow = 'Cena <small>Opadajuca <i class="sort_article fa fa-arrow-down"></i></small>';
        }

        $.ajax({
            url: '/fontanakupatila/includes/functions/filter_template.inc.php',
            method: "POST",
            data: {
                action,
                order
            },
            success: data => {
                $('#filter_data').html(data);
                $(`#sort_article`).html(arrow);
            }
        })
    }

    // Sort data by manufacturer
    $('input[name=filter_articles]').click(function() {
        filter_data();
    });

    function filter_data() {
        var action = 'fetch_data';
        var manufacturers = get_filter('manufacturers');

        $.ajax({
            url: '/fontanakupatila/includes/functions/filter_template.inc.php',
            method: "POST",
            data: {
                action,
                manufacturers
            },
            success: data => {
                $('#filter_data').html(data);
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