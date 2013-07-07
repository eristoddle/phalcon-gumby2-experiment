// Gumby is ready to go
Gumby.ready(function() {

	// placeholder polyfil
	if(Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) {
		$('input, textarea').placeholder();
	}
});

// Document ready
$(function() {
    $('.wall').freetile();
    $('.directory').freetile();
    $('.box').each(
        function(){
            var colors = [
                "#3085d6",
                "#42a35a",
                "#ca3838",
                "#f6b83f"
            ];
            var choice = Math.floor((Math.random()*colors.length));
            $(this).css({
                'background-color': colors[choice]
            });
        }
    );
    $('.load-image').click(
        function(e){
            var image = $(this).parent().attr('data-ebay');
            $(this).parent().append('<img src="'+image+'">');
            $(this).hide();
            $('.wall').freetile();
            e.preventDefault();
        }
    );
    $('.toolbar .load-images').click(
        function(){
            $('.box').each(
                function(){
                    var image = $(this).children('.image').attr('data-image');
                    $(this).children('.image').append('<img src="'+image+'">');
                    $(this).find('.load-image').hide();
                }
            );
            $('.wall').freetile();
        }
    );
    $('.toolbar .bids-only').click(
        function(){
            $('.box').each(
                function(){
                    var $biddiv = $(this).find('.bid-count');
                    if($biddiv.text().length < 1){
                        $(this).hide();
                    }
                }
            );
            $('.wall').freetile();
        }
    );
});

