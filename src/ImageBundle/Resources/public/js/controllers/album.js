var AlbumController = {
    albumList: function(){

        var url = Routing.generate('image_ajax_album_list');

        $.ajax({
            url: url,
            dataType: 'json',
            success: function(data){
                var albumArray = [];

                for (var i = 0; i < data.length; i++) {

                    albumArray.push({
                        id: data[i].id,
                        url: '#album/' + data[i].id,
                        imageSrc: 'https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=250&h=250',
                        name: data[i].name
                    });

                }

                var albumCollection     = new AlbumCollection(albumArray);
                var albumCollectionView = new AlbumCollectionView({
                    collection: albumCollection
                });

                ImageApp.regions.album.show(albumCollectionView);
            },
            error: function(error) {
                console.log(error);
            }
        });
    },
    imageList: function(id, page){

        page = page === null ? 1 : page;

        var imagesUrl = Routing.generate('image_ajax_album_items_by_page', {
            id: id,
            page: page
        });

        $.ajax({
            url: imagesUrl,
            dataType: 'json',
            success: function(data){
                var imagesArray = [];

                for (var i = 0; i < data.length; i++) {
                    imagesArray.push({
                        id:     data[i].id,
                        file:   data[i].file,
                        title:  data[i].title
                    });
                }

                var imagesCollection = new ImagesCollection(imagesArray);
                var imagesCollectionView = new ImageCollectionView({
                    collection: imagesCollection
                });

                ImageApp.regions.album.show(imagesCollectionView);
                ImageApp.regions.pagination.show(new PaginationView({
                    template: function(){
                        var paginationTemplate;

                        var url = Routing.generate('image_album_pagination', {
                            id:     id,
                            page:   page
                        });
                        console.log(url);
                        $.ajax({
                            url: url,
                            async: false,
                            success: function(data){
                                paginationTemplate = _.template(data);
                            }
                        });

                        return paginationTemplate;
                    }
                }));
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
};