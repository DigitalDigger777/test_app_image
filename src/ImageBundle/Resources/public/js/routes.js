var AlbumRouter = Backbone.Marionette.AppRouter.extend({
    appRoutes: {
        "": "albumList",
        "album/:id": "imageList",
        "album/:id/page/:page": "imageList"
    }
});