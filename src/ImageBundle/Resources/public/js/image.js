(function($){

    $(document).ready(function(){

        var page    = window.location.hash.replace('#','');
        var albumId = $('.navigation[data-album-id]').data('albumId');

        var loadItems = function(albumId, page, success){

            var url = Routing.generate('image_ajax_album_items_by_page', {
                id: albumId,
                page: page
            });

            $.ajax({
                url: url,
                success: success,
                error: function(error) {
                    console.log(error);
                }
            });
        };

        loadItems(albumId, page, function(data){
            $('.album-items').html(data);
            window.location.hash = page;
        });

        $('body').on('click', '[data-href]', function(e){
            window.location = $(this).attr('data-href');
        });


        $('.pagination li a').click(function(e){

            var self    = $(this);

            page = self.text();

            loadItems(albumId, page, function(data) {
                $('.album-items').html(data);
                window.location.hash = page;
            });

            $('.pagination li').removeClass('active');
            self.parent('li').addClass('active');

            e.preventDefault();
        });
    });

})(jQuery)