Gumby.ready(function () {
    // placeholder polyfil
    if (Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) {
        $('input, textarea').placeholder();
    }
});

// Document ready
$(function () {
    $('.wall').freetile();
    $('.directory').freetile();
    $('.box').each(function () {
        var colors = [
            "#3085d6",
            "#42a35a",
            "#ca3838",
            "#f6b83f"
        ];
        var choice = Math.floor((Math.random() * colors.length));
        $(this).css({
            'background-color': colors[choice]
        });
    });
    $('.box').click(function (e) {
        var selected_count;
        if($(this).attr('data-selected') == 'false'){
            $(this).attr('data-selected','true');
            $(this).css({
                'background-color': '#cccccc'
            });
        }else if($(this).attr('data-selected') == 'true'){
            $(this).attr('data-selected','false');
            var colors = [
                "#3085d6",
                "#42a35a",
                "#ca3838",
                "#f6b83f"
            ];
            var choice = Math.floor((Math.random() * colors.length));
            $(this).css({
                'background-color': colors[choice]
            })
        }
        if (selected_count = $(".box[data-selected='true']").length){
            $('.selected-count a').text("Selected: " + selected_count);
            $('.selected-count').show();
        }else{
            $('.selected-count').hide();
        }
    });
    $('.only-bids').click(function (e) {
        $('.box').each(function () {
            if (!parseInt($(this).attr('data-bids'))) {
                $(this).remove();
            }
        });
        $(this).hide();
        $('.wall').freetile();
        e.preventDefault();
    });
});

